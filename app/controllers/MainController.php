<?php


namespace app\controllers;


use webshop\Cache;

class MainController extends AppController
{

    public function indexAction()
    {

        $this->setMeta('Main page', 'Descript...', 'Keywords');

    }
}