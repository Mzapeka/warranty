<div class="col-md-10">
    <h3 class="bg-info"><?=$_SESSION['name']?></h3>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        $i = "a";
        if($info[0]){
        foreach ($info as $customer){?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading<?=$i?>">
                <h4 class="panel-title">
                    <a <?php if ($i != "a") echo "class=\"collapsed\"";?> data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i?>" aria-expanded="<?php if ($i != "a"){ echo "false";} else {echo "true";}?>" aria-controls="collapse<?=$i?>">
                        <?=$customer['name']?>    <span class="badge"><?=$customer['count']?></span>
                    </a>
                </h4>
            </div>
            <div id="collapse<?=$i?>" class="panel-collapse collapse <?php if ($i == "a") echo "in";?>" role="tabpanel" aria-labelledby="heading<?=$i?>">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Артикул</th>
                                <th>Тип</th>
                                <th>Серийный номер</th>
                                <th>Накладная</th>
                                <th>Акт</th>
                                <th>Дата продажи</th>
                                <th>Дата установки</th>
                                <th>Дата окончания гарантии</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
								 $j = 1;
                            if($customer['deviceInfo']){
                                foreach ($customer['deviceInfo'] as $device){?>
                            <tr>
                                <td><?=$j?></td>
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
                                    }}?>
                            </tbody>
                        </table>
                    </div>
                    <a href="<?=SITE."dealer/addDev?user=".$customer['userId']."&name=".$customer['name']?>" class="btn btn-primary btn-sm" role="button">Добавить</a>
                </div>
            </div>
        </div>
            <?php $i++; } }
        else {
            echo "<p>Клиенты не найдены</p>";
        }?>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрити</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Номер счета</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="<?=SITE."admin/regBill"?>">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Введите номер счета:</label>
                        <input type="text" class="form-control" id="recipient-name" name="bill">
                        <input type="hidden" class="transfer" name="trans"/>
                    </div>
                    <button type="submit" class="btn btn-primary">OK</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрити</button>
            </div>
        </div>
    </div>
</div>