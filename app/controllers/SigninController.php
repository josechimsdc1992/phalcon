<?php

class SigninController extends BaseController
{

	
    public function indexAction()
    {
        
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_LAYOUT);
    }
    public function __CreateUser(Usuario $user)
    {
        $this->session->set('id',$user->id);
        $this->session->set('role',$user->role);
        return $this->response->redirect('dashboard/');
    }

     public function LogearAction()
    {
        if($this->security->checkToken()==false)
        {
            $this->flash->error('Invalid CSRF Token');
            return $this->response->redirect('signin/'); 
        }
        $this->view->disable();

        $email=$this->request->getPost('email');
        $password=$this->request->getPost('password');
        $user=Usuario::findFirstByEmail($email);

        // $user=Usuario::findFirst([
        // 		"email = :email: AND password = :password:",
        // 		"bind"=>
        // 		[
        // 			"email"=>$email,
        // 			"password"=>$password
        // 		]
        // ]);


        if($user){
        	if($this->security->checkHash($password,$user->password)){
            	$this->__CreateUser($user);
            }
        }
        

     	$this->flash->error('Usuario o Contraseña incorrectas');
    	return $this->response->redirect('signin/');    
    	


        

    }
     public function LogoutAction()
    {
       
        $this->session->destroy();
        return $this->response->redirect('signin/');    
        

    }

     public function RegisterAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_LAYOUT);
    }

     public function DoregisterAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_LAYOUT);
        if($this->security->checkToken()==false)
        {
            $this->flash->error('Invalid CSRF Token');
            return $this->response->redirect('signin/register'); 
        }

        $email=$this->request->getPost('email');
        $nombre=$this->request->getPost('nombre');
        $password=$this->request->getPost('password');
        $confirm_password=$this->request->getPost('confirm_password');
        if($password!=$confirm_password)
        {

            $this->flash->error('Passwords not match');
            return $this->response->redirect('signin/register');    
        }

        $usuario=new Usuario();
        $usuario->nombre=$nombre;
        $usuario->email=$email;
        $usuario->password=$password;
        $usuario->role='user';
        //$this->security->hash($password);
        // $usuario->created=date("Y-m-d H:i:s");
        // $usuario->update=date("Y-m-d H:i:s");
        
        if ($usuario->save()===false) {
        
        $messages = $usuario->getMessages();
        $output=[];
        foreach ($messages as $message) {
                $output[]=$message;
            }
            $output=implode(',', $output);
            $this->flash->error($output);
            return $this->response->redirect('signin/register');    
        }
         else {

            $this->__CreateUser($usuario);
        }

        
    }

    

}