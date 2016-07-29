<script src="<?=SITE?>sources/js/userForm.js"></script>
<div class="container marketing">

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-3 col-sm-offset-2" id="regForm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Ввод нового пароля</h4>
            </div>
            <div class="modal-body">
                    <form role="form" method="POST" id="regForm" action="<?=SITE?>main/newPass">
                        <div class="form-group">
                            <h3>Введите новый пароль</h3>
                            <div class="form-group has-feedback">
                                <label for="pass">Пароль:</label>
                                <input type="password" class="form-control" id="pass" placeholder="Пароль - не менее 8 символов" name="pass" required="">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="pass_second">Повтор пароля:</label>
                                <input type="password" class="form-control" id="pass_second" placeholder="Повторно введите пароль" name="pass2" required="">
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>"/>

                        <input type="submit" class="btn btn-primary btn-lg btn-block" id="sendForm" value="Заменить">
                    </form>

                </div>


        </div>
    </div>
</div>