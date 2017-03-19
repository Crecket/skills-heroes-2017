<h2>Categorie Toevoegen</h2>
<form method="post" action="backend/categories/add_save/" role="form" data-toggle="validator">
    <input type="hidden" id="csrf" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>
    <div class="form-group">
        <label for="title">Titel</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="Titel" required>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
        <label for="url">URL</label>
        <input type="text" id="url" name="url" class="form-control" placeholder="URL" required>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
        <label for="description">Omschrijving</label>
        <textarea id="description" name="description" class="form-control" placeholder="Omschrijving"
                  rows="5"></textarea>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </div>
</form>
