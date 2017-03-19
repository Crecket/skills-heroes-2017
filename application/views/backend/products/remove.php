<h2>Product Verwijderen</h2>
<form method="post" action="backend/products/remove_confirm">
    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>
    <input type="hidden" name="id" value="<?= $product['id']; ?>"/>
    <div class="form-group">
        <label for="title">Weet u zeker dat u dit product wilt verwijderen?</label>
        <h4>Naam: <?= html_escape($product['name']) ?></h4>
    </div>
    <div class="form-group">
        <a href="/backend/products" class="btn btn-primary">Annuleer</a>
        <button type="submit" class="btn btn-danger">Verwijder</button>
    </div>
</form>
