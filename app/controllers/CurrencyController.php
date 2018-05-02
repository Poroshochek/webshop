<?php

namespace app\controllers;


use webshop\App;

class CurrencyController extends AppController
{
    public function changeAction()
    {
        $currency = !empty($_GET['curr']) ? $_GET['curr'] : null;
        if ($currency) {
            //get currency from DB
            //$curr = \R::findOne('currency', 'code = ?', [$currency]);

            //get currency from Registry
            $curr = App::$app->getProperty('currency');
            if (!empty($curr)) {
                setcookie('currency', $currency, time() + 3600*24*7, '/');
            }
        }
        redirect();
    }
}