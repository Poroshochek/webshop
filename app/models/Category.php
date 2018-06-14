<?php
/**
 * Created by PhpStorm.
 * User: ESoluk
 * Date: 14.06.2018
 * Time: 12:47
 */

namespace app\models;


use webshop\App;

class Category extends AppModel
{
    public function getIdes($id)
    {
        $cats = App::$app->getProperty('cats');
        $ids = null;
        foreach($cats as $k => $v){
            if($v['parent_id'] == $id){
                $ids .= $k . ',';
                $ids .= $this->getIdes($k);
            }
        }
        return $ids;
    }
}