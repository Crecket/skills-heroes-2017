<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h3> Wachtwoord aanpassen</h3>
        <p>De minimale vereiste lengte is momenteel 7 karakters!</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form method="post" action="/backend/password/update" role="form" data-toggle="validator">
            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>

            <div class="form-group">
                <label for="current_password">Huidige Wachtwoord</label>
                <input type="password" name="current_password" class="form-control" id="current_password"
                       placeholder="Huidige Wachtwoord" required>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
                <label for="new_password">Nieuw Wachtwoord</label>
                <input type="password" name="new_password" class="form-control" id="new_password"
                       placeholder="Nieuw Wachtwoord" required>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
                <label for="password_repeat">Wachtwoord herhalen</label>
                <input type="password" name="password_repeat" class="form-control" id="password_repeat"
                       placeholder="Wachtwoord herhalen" required>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Wachtwoord Aanpassen</button>
            </div>
        </form>
    </div>
</div>