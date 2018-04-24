<?php

namespace webshop\base;


class View
{
    public $route;
    public $contoller;
    public $model;
    public $view;
    public $prefix;
    public $layout;
    public $data = [];
    public $meta = [];

    public function __construct($route, $layout = '', $view = '', $meta)
    {
        $this->route = $route;
        $this->contoller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->meta = $meta;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($data)
    {
        if (is_array($data)) extract($data);
        $viewFile = APP . "/views/{$this->prefix}{$this->contoller}/{$this->view}.php";
        if (file_exists($viewFile)) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        } else {
            throw new \Exception("View {$viewFile} Not found =(", 500);
        }

        if ($this->layout !== false) {
            $layoutFile = APP . "/views/Layouts/{$this->layout}.php";
            if (is_file($layoutFile)) {
                require_once $layoutFile;
            } else {
                throw  new \Exception("Could not connect base tamplate {$layout}");
            }
        }
    }

    public function getMeta()
    {
        $output = '<title>' . $this->meta['title'] . '</title>' . PHP_EOL;
        $output .= '<meta name="description" content="' . $this->meta['desc'] .'"></meta>' . PHP_EOL;
        $output .= '<meta name="keywords" content="' . $this->meta['keywords'] .'"></meta>' . PHP_EOL;

        return $output;
    }
}