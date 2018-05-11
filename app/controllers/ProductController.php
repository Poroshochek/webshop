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
        $related = \R::getAll("SELECT * FROM related_product JOIN product ON product.id = related_product.related_id
        WHERE  related_product.product_id = ?", [$product->id]);


        //ЗАПИСАТЬ В КУКИ ПРОСМОТРЕННЫЕ ТОВАРЫ

        //ПОЛУЧИТЬ ПРОСМОТРЕНЫЕ ТОВАРЫ

        //ГАЛЕРЕЯ

        $gallery = \R::findAll('gallery', 'product_id = ?', [$product->id]);

        // MODIFICATION

        $this->setMeta($product->title, $product->description, $product->keywords);
        $this->set(compact('product', 'related', 'gallery'));

    }
}