<script src="<?=SITE?>sources/js/regDevForm.js"></script>
<div class="container marketing">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-lg-offset-1 col-md-offset-1" id="regForm2">

        
            <div class="modal-header">
                <a href="<?=SITE?>dealer" type="button" class="btn close"><span>&times;</span><span class="sr-only">Закрыть</span></a>
                <h3 class="modal-title text-" id="myModalLabel">Регистрация оборудования клиента <?=$_GET['name']?></h3>
            </div>
            <div class="modal-body">

                    <form role="form" method="POST" id="regForm" action="<?=SITE?>dealer/addDevice">
						<div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <div class="form-group has-feedback">
                                <label for="devName"><span class="text-danger">*</span> Тип оборудования:</label>
                                    <div class="input-group">
                                    <input class="form-control" id="devName" placeholder="Пример: KTS540 или FWA4460" type="text" name="devName" required=""/>
                                   <span class="input-group-addon"><a tabindex="0" class="glyphicon glyphicon-question-sign text-danger" role="button" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="auto" title="Подсказка"
                                         data-content="Обязательное поле. В это поле необходимо ввести название прибора"></a></span>
                                    </div>

                            </div>
                            <div class="form-group has-feedback">
                                <label for="pn"><span class="text-danger">*</span> Артикул:</label>
                                <div class="input-group">
                                <input type="text" class="form-control" placeholder="Пример: 0684400512" name="pn" data-toggle="tooltip" required="">
                                <span class="input-group-addon"><a tabindex="0" class="glyphicon glyphicon-question-sign text-danger" role="button" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="auto" title="Подсказка"
                                      data-content="Обязательное поле. В это поле необходимо ввести заказной номер изделия. Он может находится на табличке на приборе или в накладной"></a></span>
                            </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="serial"><span class="text-danger">*</span> Серийный номер:</label>
                                <div class="input-group">
                                <input type="text" class="form-control" id="serial" placeholder="Пример: 101187538" name="serial" required="">
                                <span class="input-group-addon"><a tabindex="0" class="glyphicon glyphicon-question-sign text-danger" role="button" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="auto" title="Подсказка"
                                      data-content="Обязательное поле. В это поле необходимо ввести серийный номер изделия. Он находится на табличке на приборе"></a></span>
                            </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="invoiceDate"><span class="text-danger">*</span> Дата покупки (из накладной):</label>
                                <div class="input-group">
                                <input type="date" class="form-control" id="invoiceDate" name="invoiceDate" placeholder="ГГГГ-ММ-ДД" required="">
                                    <span class="input-group-addon"><a tabindex="0" class="glyphicon glyphicon-question-sign text-danger" role="button" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="auto" title="Подсказка"
                                       data-content="Обязательное поле. В это поле необходимо ввести дату, которой выписана накладная клиенту"></a></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="actDate">Дата установки (из акта):</label>
                                <div class="input-group">
                                <input type="date" class="form-control" id="actDate" placeholder="ГГГГ-ММ-ДД" name="actDate">
                                    <span class="input-group-addon"><a tabindex="0" class="glyphicon glyphicon-question-sign text-danger" role="button" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="auto" title="Подсказка"
                                        data-content="Если оборудование требует ввода в эксплуатацию сервисной службой, то сюда вносится дата акта выполненых работ"></a></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="invoiceN"><span class="text-danger">*</span> Номер накладной:</label>
                                <div class="input-group">
                                <input type="text" class="form-control" id="invoiceN" name="invoiceN" required="">
                                    <span class="input-group-addon"><a tabindex="0" class="glyphicon glyphicon-question-sign text-danger" role="button" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="auto" title="Подсказка"
                                       data-content="Обязательное поле. В поле вносится номер накладной, согласно которой товар отпущен клиенту"></a></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="actN">Номер акта ввода в эксплуатацию:</label>
                                <div class="input-group">
                                <input type="text" class="form-control" id="actN" name="actN">
                                    <span class="input-group-addon"><a tabindex="0" class="glyphicon glyphicon-question-sign text-danger" role="button" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="auto" title="Подсказка"
                                        data-content="Сюда нужно внести номер акта выполненых работ, если оборудование требует ввода в эксплуатацию"></a></span>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="alert alert-info" role="alert">
                                <strong>Внимание!</strong>
                                Название оборудования, серийный номер и артикул можно взять из таблички на изделии
                            </div>
                           <img src="<?=SITE?>sourses/KTS-OK.jpg" alt="Фото" class="img-responsive" style="padding-bottom: 20px"/>


                        </div>
                        <div class="col-md-12 col-sm-12">
                            <input type="hidden" name="userId" value="<?=$_GET['user']?>"/>
                            <input type="submit" class="btn btn-primary btn-lg btn-block" id="sendForm" value="Регистрация">
                        </div>
                    </form>
                </div>

        </div>
    </div>
</div>
    </div>

<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
                <h4 class="modal-title" id="myModalLabel">Ошибка ввода</h4>
            </div>
            <div class="modal-body">
                <h3 id="errorText">

                </h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>