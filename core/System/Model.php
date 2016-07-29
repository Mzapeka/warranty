<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 22.08.15
 * Time: 14:07
 */

namespace System;

abstract class Model {

    //метод генерации случайного кода
    static function genIdNum($longNum){
            $allowArray = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0,
                a, b, c, d, e, f, g, h, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z
            ];
            $result = '';
            for ($i = 0; $i < $longNum; $i++){
                $result .= $allowArray[rand(0,count($allowArray))];
            }
            return $result;
    }


    //Using: $filePath = "view/main/mailRegConfirm.php", $template = ['#mask#' => 'value']
    //метод подготовки текста письма из шаблона и переданных данных
    function regUserMailPrepare($filePath, $template = array()){
        //загрузка шаблона письма
        $tempText = file_get_contents($filePath);
        //подстановка данных пользователя в шаблон

        foreach ($template as $mask => $value){
            $patternArray[] = "/$mask/";
            $ReplaceArray[] = $value;
        }

        $preparedFile = preg_replace($patternArray, $ReplaceArray, $tempText);
        return $preparedFile;
    }

    //метод для отправки письма
    function sendMail($textMail, $recipientMail, $subject){
            $mail = Mail::instance();
            $mail->setFrom(ADMINMAIL);
            $mail->setFromName("Bosch Warranty"); // Устанавливаем имя в обратном адресе
            $result = $mail->smtpSend($recipientMail, $subject, $textMail);
            return $result;
    }

    //метод для добавления к дате произвольного интервала
    static function DateAdd($interval, $number, $date) {

    $date_time_array = getdate($date);
    $hours = $date_time_array['hours'];
    $minutes = $date_time_array['minutes'];
    $seconds = $date_time_array['seconds'];
    $month = $date_time_array['mon'];
    $day = $date_time_array['mday'];
    $year = $date_time_array['year'];

    switch ($interval) {

        case 'yyyy':
            $year+=$number;
            break;
        case 'q':
            $year+=($number*3);
            break;
        case 'm':
            $month+=$number;
            break;
        case 'y':
        case 'd':
        case 'w':
            $day+=$number;
            break;
        case 'ww':
            $day+=($number*7);
            break;
        case 'h':
            $hours+=$number;
            break;
        case 'n':
            $minutes+=$number;
            break;
        case 's':
            $seconds+=$number;
            break;
    }
    $timestamp= mktime($hours,$minutes,$seconds,$month,$day,$year);
    return $timestamp;
}

    //вычисление разници между датами. Входные даты должны быть в формате Юникс
    static function DateDiff ($interval,$date1,$date2) {
        // получает количество секунд между двумя датами
        $timedifference = $date2 - $date1;

        switch ($interval) {
            case 'w':
                $retval = bcdiv($timedifference,604800);
                break;
            case 'd':
                $retval = bcdiv($timedifference,86400);
                break;
            case 'h':
                $retval =bcdiv($timedifference,3600);
                break;
        case 'n':
            $retval = bcdiv($timedifference,60);
            break;
        case 's':
            $retval = $timedifference;
            break;

    }
        return $retval;

    }

    //конвертирует дату в формат Unix
    protected function dateToUnix($date){
        $date_elements  = explode("-",$date);
        // здесь
// $date_elements[0] = yyyy
// $date_elements[1] = mm
// $date_elements[2] = dd
        if (checkdate((int)$date_elements[1], (int)$date_elements[2], (int)$date_elements[0]))
            return mktime(0,0,0,$date_elements[1],$date_elements[2],$date_elements[0]);

        return false;
    }


    function __call($methodName, $arguments){
        echo "404 from model";
    }
} 