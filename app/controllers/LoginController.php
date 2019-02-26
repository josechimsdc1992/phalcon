<?php

class LoginController extends BaseController
{

	public function onconstruct()
     {
 //        echo 1;
    }
	public function initialize()
    {
        $this->view->setTemplateAfter('default');
    }

    public function indexAction()
    {
        
    }

     public function ProcessAction($username=false,$age=12)
    {
        // echo "<h1>Procesing...</h1>";
        // echo $username;
        // echo $age;

        // $this->dispatcher->forward(
        // [
        // 	'controller'=>'login',
        // 	'action'=>'test'
        // ]);

        $this->view->setVar('username',$username);
        $this->view->setVar('age',$age);
        $this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_AFTER_TEMPLATE);
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_LAYOUT);
    }

    //  public function TestAction()
    // {
    //     echo "<h1>TEST</h1>";
    // }

}