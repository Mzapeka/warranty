<script src="<?=SITE?>sources/js/userForm.js"></script>
<div class="container marketing">

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-3 col-sm-offset-2" id="regForm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Регистрация нового клиента</h4>
            </div>
            <div class="modal-body">
                    <form role="form" method="POST" id="regForm" action="<?=SITE?>main/regUser">
                        <div class="form-group">
                            <h3>Зарегистрируйтесь и получите гарантию на оборудование 2 года!</h3>
                            <p></p>
                            <div class="form-group has-feedback">
                                <label for="fname">Название компании:</label>
                                <input class="form-control" id="fname" placeholder="Название" type="text" name="name" required="">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="em">E-mail:</label>
                                <input type="email" class="form-control" value="<?=$user['email']?>" id="em" placeholder="E-mail" name="email" data-toggle="tooltip" required="">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="pass">Пароль:</label>
                                <input type="password" class="form-control" value="<?=$user['pass']?>" id="pass" placeholder="Пароль" name="pass" required="">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="pass_second">Повтор пароля:</label>
                                <input type="password" class="form-control" id="pass_second" placeholder="Пароль 2" name="pass2" required="">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="sector">Вид деятельности:</label>
                                <input type="text" class="form-control" id="sector" placeholder="Вид деятельности" name="sector" required="">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="distr">Регион:</label>
                                <input type="text" class="form-control" id="distr" placeholder="Регион" name="district" required="">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="phone1">Контактный телефон:</label>
                                <input type="text" class="form-control" id="phone1" placeholder="Телефон в формате +380ххххххххх" name="phone" data-toggle="tooltip" required="">
                            </div>
                        </div>
                        <div class="form-group">

                            <label>
                                <input type="checkbox" name="agree" value="agree">
                                <?=AGREEMENT?>
                                <!--<a href="http://www.bosch.ua/imprint/uk/imprints.php?tab=2&KeepThis=true&TB_iframe=true&height=600&width=980&content=[.cntWrapper]" target="_blank">условий</a>-->
                            </label>
                        </div>
                        <input type="submit" class="btn btn-primary btn-lg btn-block" id="sendForm" value="Зарегистрироваться">
                    </form>

                </div>


        </div>
    </div>
</div>