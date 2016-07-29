<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 17.11.15
 * Time: 22:26
 */

namespace View;


use System\View;

class Dealer extends View {

    private function menu($item){
        include_once("View/dealer/menu.php");
    }

    public function showDealerInterface($info){
        $this->loadHeader();
        $this->menu(1);
        include_once("View/dealer/mainForm.php");
        $this->loadfooter();
    }
    public function showUsers($data){
        $this->loadHeader();
        $this->menu(2);
        include_once("View/dealer/customers.php");
        $this->loadfooter();
    }

    public function userRegForm(){
        $this->loadHeader();
        include_once("View/dealer/userRegForm.php");
        $this->loadfooter();
    }

    public function addDevForm(){
        $this->loadHeader();
        include_once("View/dealer/devAddForm.php");
        $this->loadfooter();
    }

	public function showSettings() {
		$this->loadHeader();
        $this->menu(3);
		echo "Данный раздел находится в разработке";
		$this->loadfooter();
	}



}