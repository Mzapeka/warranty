<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Регистрация продленной гарантии на диагностическое оборудование Bosch">
    <meta name="author" content="Bosch Украина">
    <link rel="alternate" hreflang="RU" href="alternateURL">


    <title>Bosch Warranty</title>

    <!-- CSS-ядро Bootstrap -->
    <link href="<?=SITE?>sources/css/bootstrap.min.css" rel="stylesheet">

    <!-- Підібрані стилі саме для цього сайту-->
    <link href="<?=SITE?>sources/css/bosch.css" rel="stylesheet">
    <script src="<?=SITE?>sources/js/jquery.min.js"></script>

</head>
<!-- NAVBAR
================================================== -->
<body>
<header>
<div class="navbar-wrapper">
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="brandn" class="navbar-brand" href="<?=SITE?>">Bosch Warranty</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Сайт Bosch<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="http://ua-ww.bosch-automotive.com/uk/">Диагностика</a></li>
                            <li><a href="http://ua.bosch-automotive.com/uk/">Автозапчасти</a></li>
                            <li><a href="http://ua-ww.bosch-automotive.com/uk/ww/services_support_workshopworld/bosch_training_center/bosch_training_center">Курсы для механиков</a></li>
                            <li class="divider"></li>
                        </ul>
                    </li>
                </ul>
                <?php
                if($_SESSION['name']){?>
                <ul class="nav navbar-nav" id="second">
                    <li><a href="<?php
                        if($_SESSION['role'] == BTS)
                            echo SITE."dealer";
                        elseif ($_SESSION['role'] == ADMIN)
                            echo SITE."admin";
                        ?>">Личный кабинет</a> </li>
                    <li><a href="<?=SITE?>main/unAuth">Выйти</a></li>
                </ul>

                <?php }?>
             </div>

        </div>
</nav>
<div class="Logo">
    <a href="http://www.bosch.ua/uk/ua/startpage_6/country-landingpage.php">
        <img src="<?=SITE?>sources/img/logo_ua.png" width="128" height="63" alt="" title="" border="0">
    </a>
</div>
</div>
</header>
<div class="main-content">