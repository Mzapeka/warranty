<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 17.11.15
 * Time: 22:23
 */

namespace Model;

use System\Model;

class Main extends Model {

    function isUser($login){
        global $db;
        $result = $db->select('users','email',['email' => "$login"]);
        if ($result == NULL){
            return false;
        }
        return true;
    }

    public function addNewUser(){
        $tableName = 'users';
        global $db;
// проверки введенных данных
        $phonePattern = "/^\+[0-9]{12}$/";
        $emailPattern = "/^[\w.]+@?([\w.]+)$/";
        $passPattern = "/[a-zA-Z0-9]{5,}/";

        if (!preg_match($emailPattern, $_POST['email'])){
            $result = [false, "Введите корректный Мейл"];
            return $result;
        }
        else {
            $mail = $_POST['email'];
        }
        if ($db->select($tableName, "mail", ['mail' => $mail])){
            $result = [false, "Такой e-mail уже зарегистрирован"];
            return $result;
        }
        if (!preg_match($passPattern, $_POST['pass'])){
            $result = [false, "Введите корректный пароль. Пароль должен содержать более 5 знаков"];
            return $result;
        }
        else {
            $pass = md5($_POST['pass']);
        }
        if ($pass != md5($_POST['pass2'])){
            $result = [false, "Введенный пароль не совпадает с первым полем"];
            return $result;
        }

        if (!preg_match($phonePattern, $_POST['phone'])) {
            $result = [false, "Введите номер телефона в формате +380442561565"];
            return $result;
        }
        else {
            $phone = $_POST['phone'];
        }
        $name = $_POST['name'];
        $sector = $_POST['sector'];
        $district = $_POST['district'];
        $userId = Model::genIdNum(8);
        $state = Model::genIdNum(8);
        // запросы на добавление в базу

        $values = [
            'userId' => "$userId",
            'email' => "$mail",
            'pass' => "$pass",
            'name' => "$name",
            'sector' => "$sector",
            'phone' => "$phone",
            'region' => "$district",
            'state' => "$state"
        ];
        $lastID = $db->insert($tableName, $values);
        if($lastID[0]){
            $result = [false, "Ошибка записи"];
            return $result;
        }

        $subject = "Bosch Waranty: активация аккаунта";
        $templatePath = "view/main/mailRegConfirm.php";
        $replase = ['#site#' => SITE."main/userConfirm?id=".$state];
        $letter = $this->regUserMailPrepare($templatePath, $replase);
        //echo $letter;
        $resSending = $this->sendMail($letter, $mail, $subject);

        if (!$resSending[0]){
            return $resSending;
        }

        $result = [$userId, "Регистрация прошла успешно!"];
        return $result;
    }

    public function userConfirmation(){
        global $db;
        //var_dump($_GET);
        $result = $db->update('users', ['state' => '0'], ['state', $_GET['id']]);
        return $result;
    }

    public function addNewDealer(){
        $tableName = 'bts';
        global $db;
// проверки введенных данных
        $phonePattern = "/^\+[0-9]{12}$/";
        $emailPattern = "/^[\w.]+@?([\w.]+)$/";
        $passPattern = "/[a-zA-Z0-9]{5,}/";

        if (!preg_match($emailPattern, $_POST['email'])){
            $result = [false, "Введите корректный Мейл"];
            return $result;
        }
        else {
            $mail = $_POST['email'];
        }

        if ($emailFlag = $db->select($tableName, "email", ['email' => $mail])){
            $result = [false, "Такой e-mail уже зарегистрирован"];
            return $result;
        }
        if (!preg_match($passPattern, $_POST['pass'])){
            $result = [false, "Введите корректный пароль. Пароль должен содержать более 5 знаков"];
            return $result;
        }
        else {
            $pass = md5($_POST['pass']);
        }
        if ($pass != md5($_POST['pass2'])){
            $result = [false, "Введенный пароль не совпадает с первым полем"];
            return $result;
        }

        if (!preg_match($phonePattern, $_POST['phone'])) {
            $result = [false, "Введите номер телефона в формате +380442561565"];
            return $result;
        }
        else {
            $phone = $_POST['phone'];
        }
        $name = $_POST['name'];
        $adress = $_POST['adress'];
        $userId = Model::genIdNum(12);
        $state = Model::genIdNum(8);
        // запросы на добавление в базу

        $values = [
            'btsId' => "$userId",
            'email' => "$mail",
            'pass' => "$pass",
            'name' => "$name",
            'adress' => "$adress",
            'phone' => "$phone",
            'state' => "$state"
        ];
        $lastID = $db->insert($tableName, $values);
        if($lastID[0]){
            $result = [false, "Ошибка записи"];
            return $result;
        }

        $subject = "Bosch Warranty: активация аккаунта диллера";
        $templatePath = "View/main/mailDealerRegConfirm.php";
        $table = "<table>
                <tr>
                    <th>Компания</th>
                    <th>E-mail</th>
                    <th>Телефон</th>
                    <th>Адрес</th>
                </tr>
                <tr>
                    <td>$name</td>
                    <td>$mail</td>
                    <td>$phone</td>
                    <td>$adress</td>
                </tr>
                </table>
    ";
        $replase = ['#site#' => SITE."main/dealerConfirm?id=".$state,
                    '#dillerInformation#' => $table];
        $letter = $this->regUserMailPrepare($templatePath, $replase);
        //echo $letter;
        $resSending = $this->sendMail($letter, ADMINMAIL, $subject);

        if (!$resSending[0]){
            return $resSending;
        }

        $result = [$userId, "Регистрация прошла успешно!"];
        return $result;
    }

    public function dealerConfirmation(){
        global $db;
        //var_dump($_GET);
        $mail = $db->select('bts', 'email', array('state' => $_GET['id']));
        if(!$mail){
            return array(false, "Код регистрации не найден");
        }
        $result = $db->update('bts', ['state' => '0'], ['state', $_GET['id']]);
        //var_dump($result);
        if ($result[0] != "00000"){
            return array(false, "Ошибка записи в базу");
        }
        $subject = "Bosch Warranty: подтверждение регистрации";
        $templatePath = "View/main/mailRegistarationConf.php";
        $replase = ['#site#' => SITE];
        $letter = $this->regUserMailPrepare($templatePath, $replase);
        //echo $letter;
        $resSending = $this->sendMail($letter, $mail[0]['email'], $subject);
        //var_dump($mail);
        if (!$resSending[0]){
            return $resSending;
        }
        return array(true, "Подтверждение регистрации прошло успешно");
    }

    public function passResset(){
        global $db;
        if (!$db->select('bts', 'email', array('email' => $_POST['email']))){
            return array(false, "Мейл не найден");
        }
        $ressetCode = $this->genIdNum(8);
        $result = $db->update('bts',array('status' => $ressetCode),array('email', $_POST['email']));
        //var_dump($result);
        if ($result[0] != "00000"){
            return array(false, $result);
        }
        $subject = "Bosch Warranty: сброс пароля";
        $templatePath = "View/main/mailPassResset.php";
        $replase = ['#site#' => SITE."main/passwordResset?id=".$ressetCode];
        $letter = $this->regUserMailPrepare($templatePath, $replase);
        //echo $letter;
        $resSending = $this->sendMail($letter, ADMINMAIL, $subject);
        if (!$resSending[0]){
            return $resSending;
        }
        return array(true, "Код сброса успешно создан");
    }

    public function newPassAction(){
        $tableName = 'bts';
        global $db;
// проверки введенных данных
        $passPattern = "/[a-zA-Z0-9]{5,}/";
        if(!$db->select($tableName, 'status', array('status'=>$_POST['id']))){
            return [false, "Неверный код сброса"];
        }
        if (!preg_match($passPattern, $_POST['pass'])){
            return [false, "Введите корректный пароль. Пароль должен содержать более 5 знаков"];
        }
        else {
            $pass = md5($_POST['pass']);
        }
        if ($pass != md5($_POST['pass2'])){
            $result = [false, "Введенный пароль не совпадает с первым полем"];
            return $result;
        }
        $result = $db->update($tableName, array('pass'=>$pass, 'status'=>'0'), array('status', $_POST['id']));
        if ($result[0] != "00000"){
            return array(false, $result[0]);
        }
        return array(true, "Пароль успешно изменен");
    }

    public function addNewAdmin(){
        $tableName = 'superUser';
        global $db;
// проверки введенных данных
        $emailPattern = "/^[\w.]+@?([\w.]+)$/";
        $passPattern = "/[a-zA-Z0-9]{7,}/";

        if (!preg_match($emailPattern, $_POST['email'])){
            $result = [false, "Введите корректный Мейл"];
            return $result;
        }
        else {
            $mail = $_POST['email'];
        }

        if ($emailFlag = $db->select($tableName, "email", ['email' => $mail])){
            $result = [false, "Такой e-mail уже зарегистрирован"];
            return $result;
        }
        if (!preg_match($passPattern, $_POST['pass'])){
            $result = [false, "Введите корректный пароль. Пароль должен содержать более 8 знаков"];
            return $result;
        }
        else {
            $pass = md5($_POST['pass']);
        }
        if ($pass != md5($_POST['pass2'])){
            $result = [false, "Введенный пароль не совпадает с первым полем"];
            return $result;
        }

        $name = $_POST['name'];
        $idAdmin = Model::genIdNum(12);
        $state = Model::genIdNum(8);
        // запросы на добавление в базу

        $values = [
            'idAdmin' => "$idAdmin",
            'email' => "$mail",
            'pass' => "$pass",
            'name' => "$name",
            'state' => "$state"
        ];
        $lastID = $db->insert($tableName, $values);
        if($lastID[0]){
            $result = [false, "Ошибка записи"];
            return $result;
        }

        $subject = "Bosch Warranty: активация аккаунта администратора";
        $templatePath = "View/main/mailAdminRegConfirm.php";
        $table = "<table>
                <tr>
                    <th>Администратор</th>
                    <th>E-mail</th>
                </tr>
                <tr>
                    <td>$name</td>
                    <td>$mail</td>
                </tr>
                </table>
    ";
        $replase = ['#site#' => SITE."main/adminConfirm?id=".$state,
            '#dillerInformation#' => $table];
        $letter = $this->regUserMailPrepare($templatePath, $replase);
        //echo $letter;
        $resSending = $this->sendMail($letter, ADMINMAIL, $subject);

        if (!$resSending[0]){
            return $resSending;
        }

        $result = [$userId, "Регистрация прошла успешно!"];
        return $result;

    }

    public function adminConfirmation(){
        global $db;
        //var_dump($_GET);
        $mail = $db->select('superUser', 'email', array('state' => $_GET['id']));
        if(!$mail){
            return array(false, "Код регистрации не найден");
        }
        $result = $db->update('superUser', ['state' => '0'], ['state', $_GET['id']]);
        //var_dump($result);
        if ($result[0] != "00000"){
            return array(false, "Ошибка записи в базу");
        }
        $subject = "Bosch Warranty: подтверждение регистрации";
        $templatePath = "View/main/mailRegistarationConf.php";
        $replase = ['#site#' => SITE."main/audit"];
        $letter = $this->regUserMailPrepare($templatePath, $replase);
        //echo $letter;
        $resSending = $this->sendMail($letter, $mail[0]['email'], $subject);
        //var_dump($mail);
        if (!$resSending[0]){
            return $resSending;
        }
        return array(true, "Подтверждение регистрации прошло успешно");
    }

}