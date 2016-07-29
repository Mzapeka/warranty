<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 17.11.15
 * Time: 22:23
 */

namespace Model;
use System\Model;

class Dealer extends Model {
    public function getAllData($flag = true){
        global $db;
        $customers = $db->select('users', false, array('btsId' => $_SESSION['id']));
        //var_dump($_SESSION);
        //var_dump($customers);
        if (is_array($customers)){
            if($flag){
                foreach ($customers as &$customer){
                    $devices =$db->select('warBase', false, array('idUser'=>$customer['userId']));
                    if (is_array($devices)){
                        foreach ($devices as &$device){
                            if(is_array($device)){
                                $invDate = $this->dateToUnix($device['invoiceDate']);
                                $actDate = $this->dateToUnix($device['actDate']);
                                $actDate ? $starDate = $actDate : $starDate = $invDate;
                                $endDate = Model::DateAdd('m', 24, $starDate);
                                $device['endDate'] = date("Y-m-d", $endDate);
                            }
                        }
                        $customer['deviceInfo'] = $devices;
                        $customer['count'] = count($devices);
                    }
                    else{
                        $customer['deviceInfo'] = null;
                        $customer['count'] = 0;
                    }
                }
            }
        }
        else {
            return array(false, "У вас нет клиентов");
        }
        return $customers;
    }

    public function userRegistration(){
        $tableName = 'users';
        global $db;
// проверки введенных данных

        $phonePattern = "/^\+[0-9]{12}$/";
        $emailPattern = "/^[\w.]+@?([\w.]+)$/";
        if($_POST['email']){
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
        }
        if($_POST['phone']){
            if (!preg_match($phonePattern, $_POST['phone'])) {
                $result = [false, "Введите номер телефона в формате +380442561565"];
                return $result;
            }
            else {
                $phone = $_POST['phone'];
            }
        }
        $name = $_POST['name'];
        $idDealer = $_SESSION['id'];
        $adress = $_POST['adress'];
        $userId = Model::genIdNum(8);
        $state = 0;
        // запросы на добавление в базу

        $values = [
            'userId' => "$userId",
            'email' => "$mail",
            'adress' => "$adress",
            'name' => "$name",
            'phone' => "$phone",
            'btsId' => "$idDealer",
            'state' => "$state"
        ];
        $lastID = $db->insert($tableName, $values);
        if($lastID[0]){
            $result = [false, "Ошибка записи"];
            return $result;
        }

        $result = [$userId, "Регистрация прошла успешно!"];
        return $result;
    }

    public function addNewDevice(){
        $tableName = "warBase";
        global $db;
// проверки введенных данных
        $check = $this->checkDevice();
        if (!$check[0]){
            return $check;
        }
        $idUser = $_POST['userId'];
        $pn = $_POST['pn'];
        $serial = $_POST['serial'];
        $devName = $_POST['devName'];
        $dealerName = $_SESSION['name'];
        $invoiceDate = $_POST['invoiceDate'];
        $actDate = $_POST['actDate'];
        $invN = $_POST['invoiceN'];
        $actN = $_POST['actN'];

        // запросы на добавление в базу

        $values = [
            'idUser' => "$idUser",
            'devName' => "$devName",
            'dealerName' => "$dealerName",
            'pn' => "$pn",
            'serialN' => "$serial",
            'invoiceDate' => "$invoiceDate",
            'actDate' => "$actDate",
            'invoiceN' => "$invN",
            'actN' => "$actN"
        ];

        $result = $db->insert($tableName, $values);

        if($result != "00000"){
            return array(false, "Ошибка записи");
        }

        $result = [true, "Регистрация прошла успешно!"];
        return $result;
    }
    public function checkDevice($serialize = false){
        $tableName = "warBase";
        global $db;
        function result($text, $fild, $error = false){
            $array = array('err' => $error, 'text' => $text, 'fild'=> $fild);
            return $array;
        }
// проверки введенных данных

        if (!$_POST['devName']){
            if ($serialize)
                return json_encode(result("Введите тип оборудования", "devName"));
            return array(false, "Введите тип оборудования");
        }
        if (!preg_match("/[\w]{10}?/", $_POST['pn'])){
            if ($serialize)
                return json_encode(result("Артикул должен состоять из 10 знаков (цифры и буквы)", "pn"));
            return array(false, "Артикул должен состоять из 10 знаков (цифры и буквы)");
        }

        if (!$_POST['serial']){
            if ($serialize)
                return json_encode(result("Введите серийный номер", "serial"));
            return array(false, "Введите серийный номер");
        }

        if ($db->select($tableName, "serialN", array('serialN' => $_POST['serial']))){
            if ($serialize)
                return json_encode(result("Прибор с таким серийным номером уже зарегистрирован. Проверьте пожалуйста номер", "serial"));
            return array(false, "Прибор с таким серийным номером уже зарегистрирован. Проверьте пожалуйста номер");
        }
        if (!$_POST['invoiceDate']){
            if ($serialize)
                return json_encode(result("Заполните дату покупки", "invoiceDate"));
            return array(false, "Заполните дату покупки");
        }

        if (!$_POST['invoiceN']){
            if ($serialize)
                return json_encode(result("Заполните номер накладной", "invoiceN"));
            return array(false, "Заполните номер накладной");
        }
		
		if ($_POST['actN'] == NULL & $_POST['actDate'] != NULL){
            if ($serialize)
                return json_encode(result("Заполните номер акта", "actN"));
            return array(false, "Заполните номер акта");
        }
		

        $unixInvDate = $this->dateToUnix($_POST['invoiceDate']);
        $unixActData = $this->dateToUnix($_POST['actDate']);

        if (!$unixInvDate){
            if ($serialize)
                return json_encode(result("Введена некоректная дата покупки", "invoiceDate"));
            return array(false, "Введена некоректная дата покупки");
        }
        if ($unixInvDate > time()){
            if ($serialize)
                return json_encode(result("Дата покупки должна быть меньше сегоднешнего дня", "invoiceDate"));
            return array(false, "Дата покупки должна быть меньше сегоднешнего дня");
        }
        $data = Model::DateAdd('m', 1, $unixInvDate);
        if (Model::DateAdd('m', 1, $unixInvDate) < time()){
            if ($serialize)
                return json_encode(result("Регистрация возможна не позднее месяца с даты продажи", "invoiceDate"));
            return array(false, "Регистрация возможна не позднее месяца с даты продажи");
        }

        if ($unixActData){
            if ($unixActData > time()){
                if ($serialize)
                    return json_encode(result("Дата установки должна быть меньше сегоднешнего дня", "actDate"));
                return array(false, "Дата установки должна быть меньше сегоднешнего дня");
            }

            if ($unixActData < $unixInvDate){
                if ($serialize)
                    return json_encode(result("Дата установки не может быть раньше даты продажи", "actDate"));
                return array(false, "Дата установки не может быть раньше даты продажи");
            }

            if(Model::DateDiff('w', $unixActData, $unixInvDate) > 13){
                if ($serialize)
                    return json_encode(result("Дата установки не может быть позже 3х месяцев", "actDate"));
                return array(false, "Дата установки не может быть позже 3х месяцев");
            }
        }
        if ($serialize)
            return json_encode(result("Ok", "", true));
        return [true, "Ok"];
    }
}