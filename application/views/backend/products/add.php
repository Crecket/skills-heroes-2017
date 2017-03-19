<h2>Product Toevoegen</h2>
<form method="post" action="backend/products/add_save/" enctype="multipart/form-data"
      role="form" data-toggle="validator">
    <input type="hidden" id="csrf" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>


    <div class="form-group product_form_name_group">
        <label for="name">Naam</label>
        <input type="text" id="name" name="name" class="form-control product_form_name_input" placeholder="Naam"
               value="<?= get_form_field('name') ?>" required>
        <div class="help-block with-errors product_form_name_label"></div>
    </div>

    <div class="form-group product_form_url_group">
        <label for="url">URL</label>
        <input type="text" id="url" name="url" class="form-control product_form_url_input" placeholder="Url"
               value="<?= get_form_field('url') ?>" required>
        <div class="help-block with-errors product_form_url_label"></div>
    </div>

    <div class="form-group">
        <label for="ean">EAN</label>
        <input type="text" id="ean" name="ean" class="form-control" placeholder="EAN"
               value="<?= get_form_field('ean') ?>">
        <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
        <label for="description">Omschrijving</label>
        <textarea id="description" name="description" class="form-control" placeholder="Omschrijving"
                  rows="5"><?= get_form_field('description') ?></textarea>
        <div class="help-block with-errors"></div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="form-group">
                <label for="category_id">Categorie</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= html_escape($category['title']) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="form-group">
                <label for="prijs">Prijs</label>
                <input type="number" step="0.01" id="prijs" name="price" class="form-control" placeholder="Prijs"
                       min="0.00" value="<?= get_form_field('price') ?>" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="file">Afbeelding</label><br>
        <label class="btn btn-primary btn-file">
            <input type="file" name="file" hidden required>
        </label>
        <div class="help-block with-errors"></div>
        <br>
        <br>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Toevoegen</button>
    </div>
</form>
