<?php


namespace app\controllers;


use webshop\Cache;

class MainController extends AppController
{

    public function indexAction()
    {
        $brands = \R::find('brand', 'LIMIT 3');
        $this->setMeta('Main page', 'Descript...', 'Keywords');
        $this->set(compact('brands'));
    }
}