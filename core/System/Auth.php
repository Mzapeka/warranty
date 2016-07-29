<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 22.05.16
 * Time: 13:31
 * Класс авторизации. Вызывается для авторизации пользователя.
 *
 *
 */

namespace System;


class Auth {
    //устанавливает таблицу пользователей в базе и названия полей в зависимости от роли
    static function authAction($userRole){
        //var_dump($userRole);
        if (!$userRole)
            $userRole = $_COOKIE['role'];

        switch ($userRole) {
            case USER:
                $tableName = 'users';
                $idName = 'userId';
                $userRole = USER;
                break;
            case BTS:
                /** @var $tableName TYPE_NAME */
                $tableName = 'bts';
                $idName = 'btsId';
                $userRole = BTS;
                break;
            case ADMIN:
                $tableName = 'superUser';
                $idName = 'idAdmin';
                $userRole = ADMIN;
                break;
            default:
                return array(false, "Роли $userRole не существует");
                break;
        }
        return Auth::choiseAuthData($tableName, $idName, $userRole);
    }

    //метод ищет пользователя с именем и паролем переданным в $_POST. Если находит - записывает в сессию
    static private function choiseAuthData($tableName, $idName, $userRole){
        global $db;
           if ($_POST['email']){
            $user = $db->select($tableName, array($idName,'state','name'), ['email'=>$_POST['email'], 'pass' => md5($_POST['pass'])]);
            //var_dump($user);
            if ($user[0][$idName]){
                Auth::exitAuth();
                Auth::setAuth($user[0][$idName], $userRole, $user[0]['state'], $user[0]['name'], $_POST['remember']);
                return array(true, "Авторизация $userRole прошла успешно");
            }
            return array(false, "$userRole : неверно введеный пароль или логин!");
        }
        //var_dump($_COOKIE);
        if ($_COOKIE['id'] && $_COOKIE['role']){
            $user =  $db->select($tableName,array($idName,'state','name'),[$idName => $_COOKIE['id']]);
            if ($user[0][$idName]){
                Auth::setAuth($_COOKIE['id'],$_COOKIE['role'], $user[0]['state'], $user[0]['name'], false);
                return array(true, "Авторизация ".$_COOKIE['role']." через куки прошла успешно");
            }
            return array(false, $_COOKIE['role'].": неверны ID в куках!");
        }
        return array(false, "Нету данных для авторизации");
    }
    //метод записывает в сессию данные авторизации. В куки тоже, если надо
    static private function setAuth($userId, $role, $status, $name, $rememberFlag){
        //session_destroy();
        session_start();
        //var_dump($userId);
        $_SESSION['id'] = $userId; //номер пользователя
        $_SESSION['role'] = $role; //роль
        //статус. если установлен, значит пользователь зарегистрирован но не авторизирован администратором
        $_SESSION['status'] = $status;
        $_SESSION['name'] = $name; //имя пользователя для вежливого обращения


        if ($rememberFlag == "on"){
            setcookie("id", $userId, time()+60*60*24, '/');
            setcookie("role", $role, time()+60*60*24, '/');
        }
    }

    static protected function checkAuth(){
        /*        switch ($_SESSION['role']){
                    case USER:
                        $user = $db->select('users', 'userId', ['userId' => $_SESSION['id']])
                        if ($user['userId']){
                            return
                        }
                }*/

        //TODO: checkAuth() method
    }

    static function exitAuth(){
        session_destroy();
        if ($_COOKIE['id']){
            setcookie("id", $_COOKIE['id'], time()-120, '/');
            setcookie("role", $_COOKIE['role'], time()-120, '/');
        }
    }
} 