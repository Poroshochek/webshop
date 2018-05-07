<?php


namespace app\controllers;


class ProductController extends AppController
{
    public function viewAction()
    {
        $alias = $this->route['alias'];
        $product = \R::findOne('product', "alias = ? AND status = '1'", [$alias]);

        if(!$product) {
            throw new \Exception('Page not found', 404);
        }

        //ХЛЕБНЫЕ КРОШКИ

        //СВЯЗАНЫЕ ТОВАРЫ

        //ЗАПИСАТЬ В КУКИ ПРОСМОТРЕННЫЕ ТОВАРЫ

        //ПОЛУЧИТЬ ПРОСМОТРЕНЫЕ ТОВАРЫ

        //ГАЛЕРЕЯ

        // MODIFICATION

        $this->setMeta($product->title, $product->description, $product->keywords);
        $this->set(compact('product'));

    }
}