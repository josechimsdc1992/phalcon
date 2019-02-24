<?php

class Projecto extends \Phalcon\Mvc\Model
{

  public function initialize()
  {
        $this->setSource('projecto');
        $this->hasOne(
            'usuarioid',
            'Usuario',
            'id'
        );

  }
  public function getSource()
  {
  	return 'projecto';
  }

 
}