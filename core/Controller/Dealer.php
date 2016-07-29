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
}
