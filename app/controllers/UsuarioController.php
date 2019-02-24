<?php

class UsuarioController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this->view->setVars(
            [
                'single'=>Usuario::findFirstById(6),
                'all'=>Usuario::find(
                    [
                        'deleted IS NULL'
                    ]
                ),
            ]
        );

        // exit(json_encode(Usuario::find(
        //             [
        //                 'deleted IS NULL'
        //             ]
        //         )->toArray(), JSON_NUMERIC_CHECK));

    }

    public function loginAction()
    {
        // method login
        // Getting a request instance
        $request = new Request();

        // Check whether the request was made with method POST
        if ($request->isPost()) {
            // Check whether the request was made with Ajax
            if ($request->isAjax()) {
                echo 'Request was made using POST and AJAX';
            }
        }

        //print_r($this->request->get());
        echo  $this->request->getQuery('demo');
        $post=$this->request->getPost();
        $this->filter->sanitize('','email');
        print_r($post);
    }

    public function relationAction()
    {
        // $projecto=Projecto::findFirstById(1);
        // var_dump($projecto->usuario->nombre);
        $usuario=Usuario::findFirstById(5);
        $projecto=new Projecto();
        $projecto->nombre='armado de cell';
        // $projecto->usuario=$usuario; //not work i dont know the reason;
        $projecto->created=date("Y-m-d H:i:s");
        
        $projecto->usuarioid=$usuario->id;
        //exit(json_encode($projecto->toArray(), JSON_NUMERIC_CHECK));
        if ($projecto->save() === false) {
        echo "Umh, We can't store projecto right now: \n";

        $messages = $projecto->getMessages();

        foreach ($messages as $message) {
            echo $message, "\n";
            }
        }
         else {
            echo 'Great, a new projecto was saved successfully!';
        }
        
        
    }

     public function projectosAction()
    {
        $projecto=Projecto::find();
        foreach ($projecto as $p) {
            echo $p->nombre;
            echo $p->usuario->nombre;
        }
        
        exit(json_encode($projecto->toArray(), JSON_NUMERIC_CHECK));
        
        
        
    }

    public function CreateAction()
    {

        $usuario=new Usuario();
        
        $usuario->nombre="jose";
        $usuario->email="josechimsdc2016@gmail.com";
        $usuario->password="5678";
        // $usuario->created=date("Y-m-d H:i:s");
        // $usuario->update=date("Y-m-d H:i:s");
        
        if ($usuario->save() === false) {
        echo "Umh, We can't store usuario right now: \n";

        $messages = $usuario->getMessages();

        foreach ($messages as $message) {
            echo $message, "\n";
            }
        }
         else {
            echo 'Great, a new usuario was saved successfully!';
        }

        
    }

    public function UpdateAction()
    {
        
        $usuario=Usuario::findFirstById(5);
        $usuario->email='yulicasanova@gmail.com';
        // $usuario->update=date("Y-m-d H:i:s");
        if(!$usuario)
        {
             echo "NO se encontro: \n";
        }else{

            if ($usuario->save() === false) {
            echo "Umh, We can't store usuario right now: \n";

            $messages = $usuario->getMessages();

            foreach ($messages as $message) {
                echo $message, "\n";
                }
            }
             else {
                echo 'Great, the usuario was saved successfully!';
            }

        }
        
    }

    public function deleteAction()
    {
        $usuario=Usuario::findFirstById(4);
        if(!$usuario)
        {
             echo "NO se encontro: \n";
        }
        else
        {
            if ($usuario->delete() === false) 
            {
                echo "NO se eliminó el registro: \n";

            }else
            {
                echo "Se eliminó el registro: \n";

            }
        }


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