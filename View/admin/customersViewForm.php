<?php
$tableName = [
    'counter' => '№',
    'userId' => 'ID',
    'name' => 'Клиент',
    'dealerName' => 'Дилер',
    'email'=> 'E-mail',
    'adress' => "Адрес",
    'phone' => "Телефон",
    'timestamp' => "Дата регистрации",
];
?>

<div class="col-md-10">
    <h3 class="bg-info">Администратор <?=$_SESSION['name']?></h3>
    <?php if (is_array($data[0])){?>
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <?php
                    foreach($tableName as $val){
                        echo "<th>".$val."</th>";
                    }
                ?>
            </tr>
            <?php
                foreach($data as $row){?>
                    <tr>
                        <?php
                        foreach($tableName as $key => $name){?>
                        <td><?=$row[$key]?></td>
                        <?php }?>
                    </tr>
                <?php }?>
        </table>
    </div>
    <?php } ?>
    <BR>
    <?php
    if ($_SESSION['state'] == 0){
        //echo $_SESSION['diallerStatus'];?>
        <form class="form-inline" action="<?=SITE."user/regDevice"?>" method="post">
            <a href="<?=SITE."admin/addDealer"?>" role="button" class="btn btn-default btn-lg">Зарегистрировать клиента</a>
        </form>
    <?php }
    else {?>
        <h3>Ваш аккаунт ожидает подтверждения</h3>
        <p>На Ваш почтовый ящик должно придти письмо, подтверждающее регистрацию.</p>
    <?php }?>
</div>