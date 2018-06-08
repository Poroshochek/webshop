<?php


namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Product;

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

        $breadcrumbs = Breadcrumbs::getBreadcrumbs($product->category_id, $product->title);

        //СВЯЗАНЫЕ ТОВАРЫ
        $related = \R::getAll("SELECT * FROM related_product JOIN product ON product.id = related_product.related_id
        WHERE  related_product.product_id = ?", [$product->id]);


        //ЗАПИСАТЬ В КУКИ ПРОСМОТРЕННЫЕ ТОВАРЫ
        $pModel = new Product();
        $pModel->setRecentlyViewed($product->id);


        //ПОЛУЧИТЬ ПРОСМОТРЕНЫЕ ТОВАРЫ

        $rView = $pModel->getRecentlyViewed();
        $recentlyViewed = null;
        if ($rView) {
            $recentlyViewed = \R::find('product', 'id IN  (' . \R::genSlots
                ($rView) . ') LIMIT 3', $rView);
        }


        //ГАЛЕРЕЯ

        $gallery = \R::findAll('gallery', 'product_id = ?', [$product->id]);

        // MODIFICATION

        $mods = \R::findAll('modification', 'product_id = ?', [$product->id]);


        $this->setMeta($product->title, $product->description, $product->keywords);
        $this->set(compact('product', 'related', 'gallery', 'recentlyViewed', 'breadcrumbs', 'mods'));

    }
}