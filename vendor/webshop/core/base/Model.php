<?php


namespace webshop\base;

use Valitron\Validator;
use webshop\Db;

abstract class Model
{
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct()
    {
        Db::instance();
    }

    public function load($data)
    {
        foreach ($this->attributes as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function save($table)
    {
        //crate mod ActiveRecord
        $tbl = \R::dispense($table);
        foreach ($this->attributes as $name => $val) {
            $tbl->$name = $val;
        }
        return \R::store($tbl);
    }

    public function validate($data)
    {
        Validator::langDir(WWW . '/validator/lang/');
        Validator::lang('ru');
        $v = new Validator($data);
        $v->rules($this->rules);
        if ($v->validate()) {
            return true;
        }
        $this->errors = $v->errors();
        return false;
    }

    public function getErrors()
    {
        $errors = '<ul>';
        foreach ($this->errors as $error) {
            foreach ($error as $err) {
                $errors .= "<li>$err</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
    }
}