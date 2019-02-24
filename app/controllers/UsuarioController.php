<?php

class UsuarioController extends \Phalcon\Mvc\Controller
{

    
    public function indexAction()
    {
        $this->view->setVars(
            [
                'single'=>Usuario::findFirstById(2),
                'all'=>Usuario::find(
                    [
                        'deleted IS NULL'
                    ]
                ),
            ]
        );

    }

    public function CreateAction()
    {

        $usuario=new Usuario();
        
        $usuario->nombre="yuli";
        $usuario->email="yuli@gmail.com";
        $usuario->password="5678";
        $usuario->created=date("Y-m-d H:i:s");
        $usuario->update=date("Y-m-d H:i:s");
        $usuario->save();
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
        
        $usuario=Usuario::findFirstById(2);
        $usuario->email='josechimsdc2016';
        $usuario->update=date("Y-m-d H:i:s");
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

    

}