<?php


namespace app\controllers;


use webshop\Cache;

class MainController extends AppController
{

    public function indexAction()
    {
        $posts = \R::findAll('test');

        $this->setMeta('Main page', 'Descript...', 'Keywords');

        $name = 'John';
        $age = '60';
        $names = ['Volodya', 'Pavlo', 'Jameson'];
        $cache = Cache::instance();
        $data = $cache->get('test');
        if (!$data) {
            $cache->set('test', $names);
        }
        $this->set(compact('name', 'age', 'names', 'posts'));
    }
}