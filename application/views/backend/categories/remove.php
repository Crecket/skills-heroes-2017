<h2>Categorie Verwijderen</h2>
<form method="post" action="backend/categories/remove_confirm">
    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>
    <input type="hidden" name="id" value="<?= $category['id']; ?>"/>
    <div class="form-group">
        <label for="title">Weet u zeker dat u deze categorie wilt verwijderen?</label>
        <h4>Naam: <?= html_escape($category['title']) ?></h4>
    </div>
    <div class="form-group">
        <a href="/backend/categories" class="btn btn-primary">Annuleer</a>
        <button type="submit" class="btn btn-danger">Verwijder</button>
    </div>
</form>
