<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 17.11.15
 * Time: 22:12
 */

namespace Controller;
use System\Auth;
use System\Controller;
use System\Model;

class Main extends Controller {

    public function index(){
    //Можна перенаправить пользователя в зависимости от роли
        if ($_SESSION['role'] == ADMIN || $_SESSION['role'] == BTS){
            //header ("Location:".MYSITE."dealer/");
            $this->view->loadMainPage();
    }
        else {
            $this->view->loadMainPage();
        }
    }

    //Методы обработки запросов диллера
// метод одбработки формы авторизации диллера
    public function dealerAuth(){
        $result = Auth::authAction(BTS);
        if ($result[0]){
            header ("Refresh:5;url=".SITE."dealer");
            //var_dump($result);
            $this->view->result($result[1]);
        }
        else{
            header ("Refresh:5;url=".SITE);
            //var_dump($result);
            $this->view->result($result[1]);
        }
    }

    // авторизация администратора
    public function adminAuth(){
        $result = Auth::authAction(ADMIN);
        if ($result[0]){
            //header ("Location:".SITE."user");
            header ("Refresh:5;url=".SITE."admin");
            //var_dump($result);
            $this->view->result($result[1]);
        }
        else{
            //header ("Location:".SITE."user");
            header ("Refresh:5;url=".SITE);
            //var_dump($result);
            $this->view->result($result[1]);
        }
    }

    //вызов метода регистрации диллера из модели
    public function regDeal(){
        $result = $this->model->addNewDealer();
        if ($result[0]){
            header ("Refresh:3;url=".SITE);
            //var_dump($result);
            $this->view->result("Aккаунт дилера добавлен. Ожидайте авторизации.");
        }
        else{
            header ("Refresh:3;url=".SITE."main/dealerReg");
            //var_dump($result);
            $this->view->result($result[1]);
        }

    }
    //вызов метода сброса пароля диллера из модели
    public function passResDeal(){
        $result = $this->model->passResset();
        if ($result[0]){
            header ("Refresh:3;url=".SITE);
            //var_dump($result);
            $this->view->result($result['1']." На ваш почтовый ящик должно придти сообщение. Для сброса пароля, перейдите поссылке в письме");
        }
        else{
            header ("Refresh:3;url=".SITE);
            //var_dump($result);
            $this->view->result($result['1']." Этот имейл не существует.<br>");
        }
    }
// обработка подтверждения сброса пароля
    public function passwordResset(){
        global $db;
        if(!$db->select('bts','status',array('status'=>$_GET['id']))){
            header ("Refresh:3;url=".SITE);
            //var_dump($result);
            $this->view->result("Ссылка не действительна.<br>");
        }
        else{
            $this->view->loadPassRessetForm($_GET['id']);
        }
    }

    public function newPass(){
        $result = $this->model->newPassAction();
        if ($result[0]){
            header ("Refresh:3;url=".SITE);
            //var_dump($result);
            $this->view->result($result['1']." Используйте для входа новый пароль");
        }
        else{
            header ("Refresh:3;url=".SITE);
            //var_dump($result);
            $this->view->result($result['1']." Пароль не удалось изменить.<br>");
        }
    }
//загрузка формы регистрации дилера
    public function dealerReg() {
        $this->view->loadDealerRegForm();
    }
// обработка подтверждения дилера администратором
    public function dealerConfirm(){
        $result = $this->model->dealerConfirmation();
        if ($result[0]){
            header ("Refresh:3;url=".SITE."dealer");
            //var_dump($result);
            $this->view->result("Aккаунт дилера активирован.");
        }
        else{
            header ("Refresh:3;url=".SITE);
            //var_dump($result);
            $this->view->result($result[1]." Ссылка не действительна.<br>");
        }
    }
// логаут
    public function unAuth(){
        Auth::exitAuth();
        header ("Location:".MYSITE);
    }
// вывод формы ввода пароля администратора
    public function audit(){
        $this->view->adminAuthForm();
    }
// вывод формы регистрации администратора
    public function adminReg(){
        $this->view->adminRegForm();
    }
// вызов метода регистрации администратора из модели
    public function regAdmin(){
        $result = $this->model->addNewAdmin();
        if ($result[0]){
            header ("Refresh:3;url=".SITE);
            //var_dump($result);
            $this->view->result("Aккаунт Администратора добавлен. Ожидайте авторизации.");
        }
        else{
            header ("Refresh:3;url=".SITE);
            //var_dump($result);
            $this->view->result($result[1]);
        }
    }
//вызов метода подтверждения регистрации администратора
    public function adminConfirm(){
        $result = $this->model->adminConfirmation();
        if ($result[0]){
            header ("Refresh:3;url=".SITE);
            //var_dump($result);
            $this->view->result("Aккаунт администратора активирован.");
        }
        else{
            header ("Refresh:3;url=".SITE);
            //var_dump($result);
            $this->view->result($result[1]." Ссылка не действительна.<br>");
        }
    }

}