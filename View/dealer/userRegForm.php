<script src="<?=SITE?>sources/js/userForm.js"></script>
<div class="container marketing">

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-3 col-sm-offset-2" id="regForm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Регистрация нового клиента</h4>
            </div>
            <div class="modal-body">
                    <form role="form" method="POST" id="regForm" action="<?=SITE?>dealer/regUserAction">
                        <div class="form-group">
                            <div class="form-group has-feedback">
                                <label for="fname">Название компании:</label>
                                <input class="form-control" id="fname" placeholder="Название" type="text" name="name" required="">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="em">E-mail:</label>
                                <input type="email" class="form-control" value="<?=$user['email']?>" id="em" placeholder="E-mail" name="email" data-toggle="tooltip" required="">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="adress">Регион:</label>
                                <input type="text" class="form-control" id="adress" placeholder="Регион" name="adress">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="phone1">Контактный телефон:</label>
                                <input type="text" class="form-control" id="phone1" placeholder="Телефон в формате +380ххххххххх" name="phone" data-toggle="tooltip">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-lg btn-block" id="sendForm" value="Регистрация">
                    </form>

                </div>


        </div>
    </div>
</div>