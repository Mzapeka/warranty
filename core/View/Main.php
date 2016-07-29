<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 17.11.15
 * Time: 22:26
 * Основной класс вида. Работает с неавторизированными пользователями
 *
 */

namespace View;


use System\View;

class Main extends View {

    public function loadMainPage(){
        $this->loadHeader();
        include_once("View/main/main.php");
        $this->loadfooter();
    }

    public function loadRegForm($user){
        $this->loadHeader();
        include_once("View/main/regForm.php");
        $this->loadfooter();
    }

    public function  loadDealerRegForm(){
        $this->loadHeader();
        include_once("View/main/regDealForm.php");
        $this->loadfooter();
    }
    public function  loadPassRessetForm($id){
        $this->loadHeader();
        include_once("View/main/passRessetForm.php");
        $this->loadfooter();
    }

    public function adminAuthForm(){
        $this->loadHeader();
        include_once("View/main/adminAuthForm.php");
        $this->loadfooter();
    }
    public function adminRegForm(){
        $this->loadHeader();
        include_once("View/main/adminRegForm.php");
        $this->loadfooter();
    }



} 