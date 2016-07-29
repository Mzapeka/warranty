<div class="col-md-10">
    <h3 class="bg-info">Администратор <?=$_SESSION['name']?></h3>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        $i = "a";
        if($info[0]){
        foreach ($info as $dealer){?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading<?=$i?>">
                <h4 class="panel-title">
                    <a <?php if ($i != "a") echo "class=\"collapsed\"";?> data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i?>" aria-expanded="<?php if ($i != "a"){ echo "false";} else {echo "true";}?>" aria-controls="collapse<?=$i?>">
                        <?=$dealer['name']?></a>
                </h4>
            </div>
            <div id="collapse<?=$i?>" class="panel-collapse collapse <?php if ($i == "a") echo "in";?>" role="tabpanel" aria-labelledby="heading<?=$i?>">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Клиент</th>
                                <th>E-mail</th>
                                <th>Артикул</th>
                                <th>Тип</th>
                                <th>Серийный номер</th>
                                <th>Накладная</th>
                                <th>Акт</th>
                                <th>Дата продажи</th>
                                <th>Дата установки</th>
                                <th>Окончание гарантии</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
								 $j = 1;
                            if($dealer['customers']){
                                foreach ($dealer['customers'] as $customer){
                                foreach ($customer['deviceInfo'] as $device){?>
                            <tr>
                                <td><?=$j?></td>
                                <td><?=$customer['name']?></td>
                                <td><?=$customer['email']?></td>
                                <td><?=$device['pn']?></td>
                                <td><?=$device['devName']?></td>
                                <td><?=$device['serialN']?></td>
                                <td><?=$device['invoiceN']?></td>
                                <td><?=$device['actN']?></td>
                                <td><?=$device['invoiceDate']?></td>
                                <td><?=$device['actDate']==0?"":$device['actDate']?></td>
                                <td><?=$device['endDate']?></td>
                            </tr>
                            <?php $j++;
                                }}}?>
                            </tbody>
                        </table>
                        </div>
                    </div>
            </div>
        </div>
            <?php $i++; } }
        else {
            echo "<p>Информация не найдена</p>";
        }?>
    </div>
</div>
