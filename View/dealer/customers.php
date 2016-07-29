<?php
$tableName = [
    'counter' => '№',
    'name' => "Клиент",
    'email' => "E-mail",
    'adress' => "Адрес",
    'phone' => "Телефон",
];
//var_dump($data);
?>
<div class="col-md-10">
    <h3 class="bg-info"><?=$_SESSION['name']?></h3>
        <?php if (is_array($data[0])){?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <?php
                        foreach($data[0] as $key => $val){
                            if ($tableName[$key])
                                echo "<th>".$tableName[$key]."</th>";
                        }
                        ?>
                    </tr>
                    <?php
                    foreach($data as $row){?>
                        <tr>
                            <?php
                            foreach($row as $key => $record){
                                if ($tableName[$key])
                                    echo "<td>".$record."</td>";
                            }?>
                        </tr>
                    <?php }?>
                </table>
            </div>
        <?php } ?>
        <BR>
        <?php
        if ($_SESSION['state'] == 0){
            //echo $_SESSION['diallerStatus'];?>
                <a href="<?=SITE."dealer/regUser"?>" role="button" class="btn btn-default btn-lg">Зарегистрировать клиента</a>
        <?php }
        else {?>
            <h3>Ваш аккаунт ожидает подтверждения</h3>
            <p>На Ваш почтовый ящик должено придти подтверждение авторизации.</p>
        <?php }?>
    </div>
