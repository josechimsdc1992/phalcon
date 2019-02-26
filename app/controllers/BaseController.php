<?php

class BaseController extends \Phalcon\Mvc\Controller
{

    public function initialize()
    {
         Phalcon\Tag::setTitle('Mi Projecto Phalcon');
         $this->assets->collection('style')
                    ->addCss('/bootstrap-template/vendor/bootstrap/css/bootstrap.min.css',false,false)
                    ->addCss('/bootstrap-template/vendor/fontawesome-free/css/all.min.css',false,false)
                    ->addCss('/bootstrap-template/css/agency.min.css',false,false);
                    // ->setTargetPath('final.css')
                    // ->setTargetUri('/css/final.css')
                    // ->join(true)
                    // ->addFilter(
                    //     new Phalcon\Assets\Filters\Csmin()
                    // );
                    

        $this->assets->collection('js')
                    ->addJs('/bootstrap-template/vendor/jquery/jquery.min.js',false,false)
                    ->addJs('/bootstrap-template/vendor/bootstrap/js/bootstrap.bundle.min.js',false,false)
                    ->addJs('/bootstrap-template/vendor/jquery-easing/jquery.easing.min.js',false,false)
                    ->addJs('/bootstrap-template/js/jqBootstrapValidation.js',false,false)
                    ->addJs('/bootstrap-template/js/contact_me.js',false,false)
                    ->addJs('/bootstrap-template/js/agency.min.js',false,false);
                    
                    // ->setTargetPath('js/production.js')
                    // ->setTargetUri('js/production.js')
                    // ->join(true)
                    // ->addFilter(new \Phalcon\Assets\Filters\Jsmin());
                    

       
    }

}