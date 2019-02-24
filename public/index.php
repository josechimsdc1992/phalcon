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

    //deployment app
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();


} catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}