<?php
try {

    

	//autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
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

    $di->set('view', function(){
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/views/');
        return $view;
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

    //deployment app
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();


} catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}