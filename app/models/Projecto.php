<?php

class Projecto extends \Phalcon\Mvc\Model
{

  public function initialize()
  {
        $this->setSource('projecto');
        $this->belongsTo(
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