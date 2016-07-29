<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 17.11.15
 * Time: 22:26
 */

namespace View;


use System\View;

class Admin extends View {

    private function menu($item){
        include_once("View/admin/menu.php");
    }

    public function loadMainPage($info){
        $this->loadHeader();
        $this->menu(1);
        include_once("View/admin/mainForm.php");
        $this->loadfooter();
    }

    public function loadDealerPage($data){
        $this->loadHeader();
        $this->menu(2);
        include_once("View/admin/dealerViewForm.php");
        $this->loadfooter();
    }
    public function loadCustomerPage($data){
        $this->loadHeader();
        $this->menu(3);
        include_once("View/admin/customersViewForm.php");
        $this->loadfooter();
    }
} 