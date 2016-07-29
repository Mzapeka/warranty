<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 22.08.15
 * Time: 13:22
 * Класс роутера. Парсит URL и определяет какой контроллер и какой метод вызывать
 * http://boschwaranty/имя_контроллера/метод_контроллера
 *
 */

namespace System;

class Routing {
    public static function loadPage(){
        $path = $_SERVER['REQUEST_URI'];
        //var_dump($path);
        $path = preg_replace("/\?.*/", '', $path);
        $pathArray = explode("/", $path);
        $entity = $pathArray[1];
        if (!$entity) $entity = "Main";
        $methodName = $pathArray[2];
        if (!$methodName) $methodName = "index";
        $pathArray = array_slice($pathArray, 3);
        $className = "\\Controller\\".$entity;
        //var_dump($methodName);
        if (class_exists($className)){
            $obj = new $className;
            if (method_exists($obj, $methodName)){
            $obj->$methodName($pathArray);
            }
            else {
                echo "404";
            }
        }
        else {
            echo "404";
        }
    }
} 