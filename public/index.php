<?php
try {

    
	//autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/',
        '../app/config/'
    ))->register();

    //dependency injection
    $di = new \Phalcon\DI\FactoryDefault();

    //config database
    $di->set('db',function()
    {
        $db=new Phalcon\Db\Adapter\Pdo\Postgresql([
            "host" => "localhost",
            "dbname" => "phalcontraining",
            "username" => "postgres",
            "password" => "1234",
            "port"=>"5432"
        ]);
        return $db;
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
     echo "Exception: ", $e->getMessage();
}
catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}
