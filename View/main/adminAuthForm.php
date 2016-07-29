<script src="<?=SITE?>sources/js/userForm.js"></script>
<form class="form-horizontal" role="form" action="<?=SITE?>main/adminAuth" method="POST" style="max-width: 90%; margin: 25px">
    <div class="form-group">
        <label for="inputLogin" class="col-sm-2 control-label">Login</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="email" id="inputLogin" placeholder="Login" required="" autofocus="">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="pass" id="inputPassword3" placeholder="Password" required="">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Запомнить меня
                </label>
            </div>
        <div class="pull-right" style="margin-right: 5%">
            <p class="navbar-text navbar-right active"><a href="/main/adminReg" class="navbar-link">Регистрация</a></p>
        </div>
        <div class="pull-left" style="margin-right: 5%">
            <p class="navbar-text navbar-right active"><a href="#myModal" data-toggle="modal" data-target="#myModal" class="navbar-link">Забыли пароль?</a></p>

        </div>
      </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Войти</button>
        </div>
    </div>
</form>