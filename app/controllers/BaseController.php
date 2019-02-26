<?php

class BaseController extends \Phalcon\Mvc\Controller
{

    public function initialize()
    {
         // \Phalcon\Taq::prependTitle('projecto');
         $this->assets->collection('style')
                    ->addCss('third-party/css/bootstrap.min.css',false,false)
                    ->addCss('css/style.css');
                    // ->setTargetPath('css/production.css')
                    // ->setTargetUri('css/production.css')
                    // ->join(true)
                    // ->addFilter(new \Phalcon\Assets\Filters\Cssmin());
                    

        $this->assets->collection('js')
                    ->addJs('third-party/js/jquery-3.3.1.min.js',false,false)
                    ->addJs('third-party/js/popper.min.js',false,false)
                    ->addJs('third-party/js/bootstrap.min.js',false,false);
                    // ->setTargetPath('js/production.js')
                    // ->setTargetUri('js/production.js')
                    // ->join(true)
                    // ->addFilter(new \Phalcon\Assets\Filters\Jsmin());
                    

       
    }

}