<?php


namespace webshop\base;


abstract class Controller
{
    public $route;
    public $contoller;
    public $model;
    public $view;
    public $prefix;
    public $data = [];
    public $meta = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->contoller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];

    }

    public function set($data)
    {
        $this->data = $data;
    }

    public function setMeta($title = '', $desc = '', $keywords = '')
    {
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;
        $this->meta['keywords'] = $keywords;
    }
}