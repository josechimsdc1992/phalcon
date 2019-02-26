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
        	return $this->response->redirect('dashboard/');
        }
        

     	$this->flash->error('Usuario o Contraseña incorrectas');
    	return $this->response->redirect('signin/');    
    	


        

    }
     public function LogoutAction()
    {
       
        $this->session->destroy();
        return $this->response->redirect('signin/');    
        

    }

    

}