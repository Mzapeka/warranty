<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 22.08.15
 * Time: 14:07
 *
 * Австрактный класс контроллера, который наследуют все контроллеры сущностей
 * Принцип действия:
 * http://boschwaranty/имя_контроллера_сущности/метод_контроллера
 *
 */

namespace System;

abstract class Controller {
    public $model;
    public $view;
    // метод, который должен выполнятся по умолчанию, если никакой другой не вызывается
    abstract function index();
//в конструкторе создаются объекты модели и вида (если такие существуют)
    function __construct(){
        $className = get_called_class();
        //print_r($className);
        $className = explode("\\", $className)[1];
        $model = "\\Model\\$className";
        //var_dump($model);
        if (class_exists($model)){
            $this->model = new $model();

            Auth::authAction(false); //позволяет авторизировать через куки
        }
        $view = "\\View\\$className";
        if (class_exists($view)){
            $this->view = new $view();
            Auth::authAction(false);
        }
    }


    function __call($methodName, $arguments){
        echo "404 from controller";
    }
} 