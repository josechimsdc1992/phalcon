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
        $this->hasMany('id','Projecto','usuarioid');
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

  public function beforeSave()
  {
       $this->created=date("Y-m-d H:i:s");
  }
  
  public function save($data = null, $whiteList = null)
  {
       $this->beforeSave();
       parent::save($data, $whiteList);
      
  }
 
   public function beforeUpdate()
  {
   
        $this->update=date("Y-m-d H:i:s");
  }
   public function beforeValidationOnCreate()
   {
      if($this->email=='josechimsdc1992@gmail.com')
      {
        die('el correo ha sido baneado');
      }
   }
  
  
}