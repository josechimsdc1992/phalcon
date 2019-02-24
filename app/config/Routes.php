<?php

class Routes extends \Phalcon\Mvc\Router\Group
{
	public function initialize()
	{
		// $router->setDefaultController('index');
  //       $router->setDefaultAction('index');

		$this->add("/superhero", array(
            "controller" => 'test',
            "action" => 'index'
        
        ));

		$this->add('/', array(
            "controller" => 'index',
            "action" => 'index'
        ));

        
        $this->add("/superhero/jump/:int", array(
            "controller" => 'test',
            "action" => 'jump',
            "id" => 1
        ));

        $this->add("/superhero/jump", array(
            "controller" => 'test',
            "action" => 'jump'
        
        ));

        $this->add("/superhero/fly/:params", array(
            "controller" => 'test',
            "action" => 'fly',
            "params" => 1
        
        ));

          // $router->add("/:controller/:action/:params", array(
        //     "controller" => 1,
        //     "action" => 2,
        //     "params" => 3
        // ));
	}
}