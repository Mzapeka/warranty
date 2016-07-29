<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 22.08.15
 * Time: 13:25
 */

function __autoload($className){
	//$files = scandir("Core/System");
	//var_dump ($className);
	$pathClass  = explode("\\",$className);
    $path = "core/".$pathClass['0']."/".ucfirst($pathClass['1']).".php";
    if (file_exists($path)){
        include_once $path;
    }
	else {
		echo "Ой!";
		die;
	}

}