<?php

$config = new \Phalcon\Config(
    [
        "database" => [
            "host"     => "localhost",
            "username" => "postgres",
            "password" => "1234",
            "dbname"   => "phalcontraining",
        ],
        "phalcon" => [
            "controllersDir" => "../app/controllers/",
            "modelsDir"      => "../app/models/",
            "viewsDir"       => "../app/views/",
        ],
    ]
);

