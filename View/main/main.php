<div class="jumbotron">
    <div class="container" id="JumbText">
        <!--    <img id="box1" class="featurette-image img-responsive" src="<?=SITE?>sourses/sis.png" alt="Generic placeholder image"> -->
        <h1>Продленная гарантия на оборудование</h1>
        <p>Вход диллера</p>
        <div class="raw">
            <div class="col-sm-4">
        <form class="form-horizontal" method="post" action="/main/dealerAuth" role="form">
            <div class="form-group">
                <label for="startEmail" class="col-sm-2 control-label mainLabel">Email</label>
                <input type="email" class="form-control" id="startEmail" placeholder="Email" name="email" required="" autofocus="">

                <label for="startPass" class="col-sm-2 control-label mainLabel">Пароль</label>
                <input type="password" class="form-control " id="startPass" placeholder="Пароль" name="pass" required="">
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label class="mainLabel">
                        <input type="checkbox" name="remember"> Запомнить меня
                    </label>

                </div>
                <div class="pull-right" style="margin-right: 5%">
                    <p class="navbar-text navbar-right"><a href="/main/dealerReg" class="navbar-link mainLink">Регистрация</a></p>
                </div>
                <div class="pull-left" style="margin-right: 5%">
                    <p class="navbar-text navbar-right"><a href="#myModal" data-toggle="modal" data-target="#myModal" class="navbar-link mainLink">Забыли пароль?</a></p>

                </div>
            </div>
                <button type="submit" class="btn btn-success">Вход</button>

        </form>
    </div>
    </div>
     </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="dilModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
                <h4 class="modal-title" id="dilModalLabel">Сброс пароля</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="/main/passResDeal">
                    <div class="form-group has-feedback">
                        <label for="inputEmail">Введите свой E-mail</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" required="" autofocus="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <input type="submit" class="btn btn-primary" name="log" value="Сбросить"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>