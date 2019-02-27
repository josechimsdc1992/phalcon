<?php
try {

    require '../app/config/Config.php';

	//autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/',
        '../app/config/'
    ))->register();

    $loader->registerClasses([
        'Component\Helper'=>'..app/components/Helper.php',
        'Component\User'=>'..app/components/User.php'
    ]);

    //dependency injection
    $di = new \Phalcon\DI\FactoryDefault();

    //config
    $di->setShared('config',function() use ($config)
    {
        return $config;
    });

    //config database
    $di->set('db',function() use ($di)
    {
        $dbConfig=(array)$di->get('config')->get('database');
        $db=new Phalcon\Db\Adapter\Pdo\Postgresql($dbConfig);
        //  $db=new Phalcon\Db\Adapter\Pdo\Postgresql([
        //     "host" => "localhost",
        //     "dbname" => "phalcontraining",
        //     "username" => "postgres",
        //     "password" => "1234",
        //     "port"=>"5432"
        // ]);
        return $db;
    });

    $di->set('url', function(){
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri('/');
        return $url;
    });

    // //vistas and volt engine
    $di->set(
    'voltService',
    function ($view, $di) {
        $volt = new Phalcon\Mvc\View\Engine\Volt($view, $di);

        $volt->setOptions(
            [
                'compiledPath'      => '../app/cache/volt',
                'compiledExtension' => '.compiled',
            ]
        );

        return $volt;
    }
    );

    // Register Volt as template engine
    $di->set(
        'view',
        function () {
            $view = new Phalcon\Mvc\View();

            $view->setViewsDir('../app/views/');

            $view->registerEngines(
                [
                    '.volt' => 'voltService',
                ]
            );

            return $view;
        }
    );

    


   $di->set('router', function() {

        $router = new \Phalcon\Mvc\Router(true);
        $router->mount(new Routes());
        $router->handle();

        return $router;

    });

    //Start the session the first time when some component request the session service
    $di->setShared(
        'session',
        function () {
            $session = new Phalcon\Session\Adapter\Files();

            $session->start();

            return $session;
        }
    );

    $di->setShared('component',function()
        {
            $obj=new stdClass();
            $obj->user=new \Component\User;
            $obj->helper=new \Component\Helper;
            return $obj;
        });

    // //metadata models
    // $di['modelsMetadata'] = function () {
    //     // Create a metadata manager with APC
    //     $metadata = new Phalcon\Mvc\Model\MetaData\Apc(
    //         [
    //             'lifetime' => 86400,
    //             'prefix'   => 'metaData',
    //         ]
    //     );

    //     // $metadata->setStrategy(
    //     //     new Phalcon\Mvc\Model\MetaData\Strategy\Annotations()
    //     // );

    //     return $metadata;
    // };
     $di->set('flash', function() {
        // There is a Direct, and a Session
        $flash = new \Phalcon\Flash\Session(array(
            'error' => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice' => 'alert alert-info',
            'warning' => 'alert alert-warning',
        ));
        return $flash;
    });

   $di->set('dispatcher',
        function () {
            // Create an event manager
            $eventsManager = new Phalcon\Events\Manager();

            // Attach a listener for type 'dispatch'
            $permission=new Permission(); 
            
            // $eventsManager->attach(
            //     'dispatch',
            //     function (Phalcon\Events\Event $event, $dispatcher) {
            //         // ...
            //     }
            // );

             $eventsManager->attach(
                'dispatch',
                $permission
            );

            $dispatcher = new Phalcon\Mvc\Dispatcher();

            // Bind the eventsManager to the view component
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        },
        true
    );

    //deployment app
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();


} 
catch(Exception $e) {
     echo '<pre>';
    echo get_class($e), ": ", $e->getMessage(), "\n";
    echo " File=", $e->getFile(), "\n";
    echo " Line=", $e->getLine(), "\n";
    echo $e->getTraceAsString();
    echo '</pre>';
}
catch(\Phalcon\Exception $e) {
     echo '<pre>';
    echo get_class($e), ": ", $e->getMessage(), "\n";
    echo " File=", $e->getFile(), "\n";
    echo " Line=", $e->getLine(), "\n";
    echo $e->getTraceAsString();
    echo '</pre>';
}
