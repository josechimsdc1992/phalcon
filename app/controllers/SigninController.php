<?php

class SigninController extends BaseController
{

	
    public function indexAction()
    {
        
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_LAYOUT);
    }

     public function LogearAction()
    {
       
        $this->view->disable();

        $user=Usuario::findFirst([
        		"email = :email: AND password = :password:",
        		"bind"=>
        		[
        			"email"=>$this->request->getPost('email'),
        			"password"=>$this->request->getPost('password')
        		]
        ]);


        if($user){
        	
        	$this->session->set('id',$user->id);
        	$this->session->set('role',$user->role);
        	exit('acceso concedido');
        }
        

     	$this->flash->error('Usuario o Contraseña incorrectas');
     //    $this->dispatcher->forward(array(
     //    "controller" => "signin",
     //    "action" => "index"
    	// ));

    	return $this->response->redirect('signin/');    
    	


        

    }

    

}