<?php

namespace app\controllers;

use app\models\AppModel;
use app\widgets\currency\Currency;
use webshop\base\Controller;
use webshop\App;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
        //widgets set currency
        App::$app->setProperty('currencies', Currency::getCurrencies());
        App::$app->setProperty('currency', Currency::getCurrency(App::$app->getProperty('currencies')));
    }
}