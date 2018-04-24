<?php


namespace app\controllers;


class MainController extends AppController
{

    public function indexAction()
    {
        echo "It`s Main controller";
        $this->setMeta('Main page', 'Descript...', 'Keywords');

        $name = 'John';
        $age = '60';
        $names = ['Volodya', 'Pavlo', 'Jameson'];
        $this->set(compact('name', 'age', 'names'));
    }
}