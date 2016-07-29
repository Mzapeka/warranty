<?php
session_start();
require_once("config.php");
require_once "autoload.php";


$db = new System\DB(DBNAME);
$obj = new System\Routing();
$obj::loadPage();