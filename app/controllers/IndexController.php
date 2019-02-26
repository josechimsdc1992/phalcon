<?php

class IndexController extends BaseController
{

    public function indexAction()
    {
        	echo 'Welcome to main page.';		
    }

    public function startsessionAction()
    {
    	 $this->session->set('user',
    	 	[
    	 		'name'=>'jose',
    	 		'age'=>'27',
    	 		'email'=>'josechimsdc1992@gmail.com'
    	 	]
    	);
    }
     public function setsessionAction()
    {
        $this->session->set('name','josechim');

        echo 'set session';

    }

     public function getsessionAction()
    {
        
        echo $this->session->get('name');

        echo 'get session';

    }

     public function removeAction()
    {
        // Remove a session variable
        $this->session->remove('name');
    }

    public function destroyAction()
    {
        // Destroy the whole session
        $this->session->destroy();
    }

}