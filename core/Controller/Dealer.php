<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 17.11.15
 * Time: 22:12
 */

namespace Controller;


use System\Controller;



class Dealer extends Controller {
    function __construct() {
        parent::__construct();
        if ($_SESSION['role'] != BTS){
            header("Refresh:3;url=".MYSITE);
            $this->view->result("Вы не не являетесь пользователем сервиса.");
            die;
        }
        if ($_SESSION['status' != 0]){
            header("Refresh:3;url=".MYSITE);
            $this->view->result("Вы не получили авторизацию. Как только Вас авторизуют - Вы получите уведомление на Ваш E-mail.");
            die;
        }
    }


    function index()
    {
        $data = $this->model->getAllData();
        $this->view->showDealerInterface($data);
    }

    public function customers(){
        $data = $this->model->getAllData(false);
        $this->view->showUsers($data);
    }

    public function regUser(){
        $this->view->userRegForm();
    }
    public function regUserAction(){
        $result = $this->model->userRegistration();
        if ($result[0]){
            header ("Refresh:3;url=".SITE."dealer/customers");
            //var_dump($result);
            $this->view->result("Новый клиент добавлен.");
        }
        else{
            header ("Refresh:3;url=".SITE."dealer");
            //var_dump($result);
            $this->view->result($result[1]);
        }
    }

    public function addDev(){
        $this->view->addDevForm();
    }

    public function addDevice(){
        $result = $this->model->addNewDevice();
        if ($result[0]){
            header ("Refresh:3;url=".SITE."dealer");
            //var_dump($result);
            $this->view->result("Новое устройство добавлено.");
        }
        else{
            header ("Refresh:3;url=".SITE."dealer");
            //var_dump($result);
            $this->view->result($result[1]);
        }
    }

    public function checkDevForm(){
        $result = $this->model->checkDevice(1);
        echo $result;
    }

	public function settings(){
		$this->view->showSettings();
    }
}