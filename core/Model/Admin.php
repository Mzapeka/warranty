<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 17.11.15
 * Time: 22:23
 */

namespace Model;
use System\Model;

class Admin extends Model {
    public function getAllData($flag = true){
        global $db;
        $btsDataList = array(
            'btsId',
            'email',
            'name',
            'adress',
            'phone'
        );
        $dealers = $db->select('bts', $btsDataList);
        if(is_array($dealers)){
            foreach($dealers as &$dealer){
                $customers = $db->select('users', false, array('btsId' => $dealer['btsId']));
        //var_dump($_SESSION);
        //var_dump($customers);
                if (is_array($customers)){
                     foreach ($customers as &$customer){
                        $devices =$db->select('warBase', false, array('idUser'=>$customer['userId']));
                        if (is_array($devices)){
                            foreach ($devices as &$device){
                                if (is_array($device)) {
                                    $invDate = $this->dateToUnix($device['invoiceDate']);
                                    $actDate = $this->dateToUnix($device['actDate']);
                                    $actDate ? $starDate = $actDate : $starDate = $invDate;
                                    $endDate = Model::DateAdd('m', 24, $starDate);
                                    $device['endDate'] = date("Y-m-d", $endDate);
                                }
                                else {
                                    $device['endDate'] = null;
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
                    $dealer['customers'] = $customers;
                }
                else {
                    $dealer['customers'] = null;
                }
            }
        }
        else {
            return array(false, "Ошибка чтения из базы");
        }
        return $dealers;
    }

    public function getDealerData(){
        global $db;
        $dealers = $db->select('bts');
        $i = 1;
        if(is_array($dealers)){
            foreach ($dealers as &$dealer){
                $dealer['counter'] = $i++;
				if ($dealer['state'] == 0){
					$dealer['state'] = "Актив.";
				}
            }
            return $dealers;
        }
        else {
            return array(false, "Ошибка чтения из базы");
        }
    }

    public function getCustomerData(){
        global $db;
        $users = $db->select('users');
        $i = 1;
        if(is_array($users)){
            foreach ($users as &$user){
                $user['counter'] = $i++;
                $dealer = $db->select('bts', array('name'), array('btsId' => $user['btsId']));
                if (is_array($dealer)){
                    $user['dealerName'] = $dealer[0]['name'];
                }
                else{
                    $user['dealerName'] = "Не существует";
                }
            }
            return $users;
        }
        else {
            return array(false, "Ошибка чтения из базы");
        }
    }
}