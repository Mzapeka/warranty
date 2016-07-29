<script src="<?=SITE?>sources/js/userForm.js"></script>
<div class="container marketing">

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-3 col-sm-offset-2" id="regForm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Регистрация дилера</h4>
            </div>
            <div class="modal-body">
                    <form role="form" method="POST" id="regForm" action="<?=SITE?>main/regDeal">
                        <div class="form-group">
                            <h3>Для оформления гарантии на оборудование 2 года необходимо зарегистрироваться</h3>
                            <p></p>
                            <div class="form-group has-feedback">
                                <label for="fname">Название компании-дилера:</label>
                                <input class="form-control" id="fname" placeholder="Название" type="text" name="name" required="">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="em">Контактный E-mail:</label>
                                <input type="email" class="form-control" id="em" placeholder="E-mail" name="email" data-toggle="tooltip" required="">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="pass">Пароль:</label>
                                <input type="password" class="form-control" id="pass" placeholder="Пароль - не менее 8 символов" name="pass" required="">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="pass_second">Повтор пароля:</label>
                                <input type="password" class="form-control" id="pass_second" placeholder="Повторно введите пароль" name="pass2" required="">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="adrr">Адрес:</label>
                                <input type="text" class="form-control" id="adrr" placeholder="Адрес" name="adress" required="">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="phone1">Контактный телефон:</label>
                                <input type="text" class="form-control" id="phone1" placeholder="Телефон в формате +380ххххххххх" name="phone" data-toggle="tooltip" required="">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-lg btn-block" id="sendForm" value="Зарегистрироваться">
                    </form>

                </div>


        </div>
    </div>
</div>