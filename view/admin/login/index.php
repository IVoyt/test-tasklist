
<div class="row">
    <div class="col-lg-12" style="text-align: center">

        <form method="POST" action="/admin/login" class="form-inline">
            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" id="username" class="form-control"
                       name="username" required
                       value="<?= (isset($_SESSION['username'])) ? $_SESSION['username'] : '' ?>" />
            </div>
            <div class="form-group">
                <label for="pass">Пароль</label>
                <input type="password" id="pass" class="form-control"
                       name="pass" required
                       value="<?= (isset($_SESSION['pass'])) ? $_SESSION['pass'] : '' ?>" />
            </div>

            <input id="submit" type="submit" value="Войти" class="btn btn-primary form-control-static" />
        </form>

    </div>
</div>