<?php

use Phalcon\Mvc\Model\Behavior\SoftDelete;

class Usuario extends \Phalcon\Mvc\Model
{

  public function getSource()
  {
  	return 'usuario';
  }

  public function initialize()
  {
        $this->setSource('usuario');
        $this->addBehavior(
            new SoftDelete(
                [
                    'field' => 'deleted',
                    'value' => '1',
                ]
            )
        );
  }
}