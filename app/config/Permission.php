<?php

use Phalcon\Mvc\Dispatcher,
    Phalcon\Events\Event,
    Phalcon\Acl;

/**
 * Permission
 *
 * Prevents User Types from accessing areas they are not allowed in.
 */
class Permission extends \Phalcon\Mvc\User\Plugin
{

    /**
     * Constants to prevent a typo
     */
    const GUEST = 'guest';
    const USER  = 'user';
    const ADMIN = 'admin';

    /**
     * Accessible to everyone
     * @var array
     */
    protected $_publicResources = [
        'index' => '*',
        'signin' => '*'
    ];

    /**
     * Accessible to Users (and Admins)
     * @var array
     */
    protected $_userResources = [
        'dashboard' => ['*']
    ];

    /**
     * Accessible to Admins
     * @var array
     */
    protected $_adminResources = [
        'admin' => ['*']
    ];

    // ------------------------------------------------------------------------

    /**
     * Triggers before a route is successfully executed
     *
     * @param  Event      $event
     * @param  Dispatcher $dispatcher
     *
     * @return boolean|void
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        // Debug:
        //$this->session->destroy();

        // Get the current role
        $role = $this->session->get('role');
        if (!$role) {
            $role = self::GUEST;
        }
        

        // Get the current Controller/Action from the Dispatcher
        $controller = $dispatcher->getControllerName();
        $action     = $dispatcher->getActionName();

        // Get the ACL Rule List
        $acl = $this->_getACL();

        // See if they have permission
        $allowed = $acl->isAllowed($role, $controller, $action);

        
        if ($allowed != Acl::ALLOW)
        {
            $this->flash->error("You do not have sufficient permissions.");
            $this->response->redirect("index");

            // Stop the dispatcher at the current operation
            return false;
        }

    }

    // ------------------------------------------------------------------------

    /**
     * Build the Session ACL list one time if it's not set
     *
     * @return object
     */
    protected function _getACL()
    {
        if (!isset($this->persistent->acl))
        {
            $acl = new Acl\Adapter\Memory();
            $acl->setDefaultAction(Acl::DENY);

            $roles = [
                self::GUEST => new Acl\Role(self::GUEST),
                self::USER  => new Acl\Role(self::USER),
                self::ADMIN => new Acl\Role(self::ADMIN),
            ];

            // Place all the roles inside the ACL Object
            foreach ($roles as $role) {
                $acl->addRole($role);
            }

            // Public Resources
            foreach ($this->_publicResources as $resource => $action) {
                $acl->addResource(new Acl\Resource($resource), $action);
            }

            // User Resources
            foreach ($this->_userResources as $resource => $action) {
                $acl->addResource(new Acl\Resource($resource), $action);
            }

            // Admin Resources
            foreach ($this->_adminResources as $resource => $action) {
                $acl->addResource(new Acl\Resource($resource), $action);
            }

            // Allow ALL Roles to access the Public Resources
            foreach ($roles as $role) {
                foreach($this->_publicResources as $resource => $action) {
                    $acl->allow($role->getName(), $resource, '*');
                }
            }

            // Allow User & Admin to access the User Resources
            foreach ($this->_userResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow(self::USER, $resource, $action);
                    $acl->allow(self::ADMIN, $resource, $action);
                }
            }

            // Allow Admin to access the Admin Resources
            foreach ($this->_adminResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow(self::ADMIN, $resource, $action);
                }
            }

            $this->persistent->acl = $acl;
        }

        return $this->persistent->acl;
    }

    // ------------------------------------------------------------------------

}