<?php

class LoginController extends \Phalcon\Mvc\Controller
{

	public function onconstruct()
 //    {
 //        echo 1;
 //    }
	public function initialize()
    {
        
    }

    public function indexAction()
    {
        echo "<h1>Loginindex</h1>";
    }

     public function ProcessAction($username=false,$age=12)
    {
        // echo "<h1>Procesing...</h1>";
        // echo $username;
        // echo $age;

        // $this->dispatcher->forward(
        // [
        // 	'controller'=>'login',
        // 	'action'=>'test'
        // ]);

        $this->view->setVar('username',$username);
        $this->view->setVar('age',$age);
    }

    //  public function TestAction()
    // {
    //     echo "<h1>TEST</h1>";
    // }

}