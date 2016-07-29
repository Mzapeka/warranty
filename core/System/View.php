<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 22.08.15
 * Time: 15:22
 *
 * Абстрактный класс вида. Его наследуют виды всех сущностей
 */

namespace System;


abstract class View {
    public function loadHeader(){
        include_once "View/header.php";
    }
    public function loadMenu(){
        include_once "View/main/main.php";
    }
    public function loadfooter(){
        include_once "View/footer.php";
    }
    // прямой вывод сообщения на экран
    public function result($result){
        $this->loadHeader();
        echo $result;
        $this->loadfooter();
    }

} 