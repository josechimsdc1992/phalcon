<?php

class BaseController extends \Phalcon\Mvc\Controller
{

    public function initialize()
    {
        $this->assets->collection('head')
                    ->addCss('css/style.css')
                    ->addJs('third-party/js/jquery-3.3.1.min.js')
                    ->addJs('https://code.jquery.com/jquery-3.3.1.min.js',true);

        $this->assets->collection('footer')
                    ->addJs('third-party/js/fake1.js')
                    ->addJs('third-party/js/fake2.js');
    }

}