<h2>Categorie Bewerken</h2>
<form method="post" action="backend/categories/edit_save/" role="form" data-toggle="validator">
    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>
    <div class="form-group">
        <label for="title">Titel</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="Titel"
               value="<?= html_escape($category["title"]) ?>" required>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
        <label for="url">URL</label>
        <input type="text" id="url" name="url" class="form-control" placeholder="URL"
               value="<?= $category["url"] ?>" required>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
        <label for="description">Omschrijving</label>
        <textarea id="description" name="description" class="form-control" placeholder="Omschrijving"
                  rows="5"><?= html_escape($category["description"]) ?></textarea>
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
        <input type="hidden" name="id" value="<?= $category["id"] ?>"/>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </div>
</form>
