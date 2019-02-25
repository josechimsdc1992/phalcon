<?php

class TestController extends BaseController
{
    public function indexAction()
    {
        echo 'index test';   
    }

    public function jumpAction($id=0)
    {
        echo 'jump';
        echo $id;
    }

    public function flyAction()
    {
        echo 'fly';
        print_r($this->dispatcher->getParams());
    }

     

}