<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form method="post" action="/backend/login/check" role="form" data-toggle="validator">
            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>
            <div class="form-group">
                <label for="username">Gebruiksnaam</label>
                <input type="username" name="username" class="form-control" id="username" placeholder="Gebruiksnaam"
                       required>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Wachtwoord"
                       required>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Inloggen</button>
            </div>
        </form>
    </div>
</div>