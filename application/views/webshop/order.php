<h2>Bestellen</h2>
<h3>Producten</h3>
<table class="table">
    <thead>
    <tr>
        <th></th>
        <th>Product</th>
        <th>Hoeveelheid</th>
        <th>Prijs</th>
    </tr>
    </thead>
    <tbody>
    <?php $total_price = 0; ?>
    <? foreach ($shopping_cart as $key => $cart_item): ?>
        <?php $total_price += ($cart_item['price'] * $cart_item['amount']); ?>
        <tr>
            <td class="order_image_col">
                <img alt="<?= html_escape($cart_item['name']) ?>" class="media-object order_image"
                     src="/files/products/<?= $cart_item['id']; ?>.jpg">
            </td>
            <td>
                <h4 class="media-heading">
                    <a href="/webshop/product/<?= $cart_item['url'] ?>">
                        <?= $cart_item['name'] ?>
                    </a>
                </h4>
                <small><?= $cart_item['description'] ?></small>
            </td>
            <td>
                <?= html_escape($cart_item['amount']) ?> x €<?= html_escape($cart_item['price']) ?>
            </td>
            <td>
                <?php
                echo html_escape($cart_item['price'] * $cart_item['amount']);
                ?>
            </td>
        </tr>
    <? endforeach; ?>
    <tr>
        <td>
            <a href="/shoppingcart" class="btn btn-info">
                Aanpassen
            </a>
        </td>
        <td>

        </td>
        <td>
            Totaal:
        </td>
        <td>
            <?php echo $total_price; ?>
        </td>
    </tr>
    </tbody>
</table>
<hr>
<h3>Gegevens</h3>

<form method="POST" action="webshop/confirm_order" role="form" data-toggle="validator">
    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>

    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="form-group">
                <label for="aanhef">Aanhef</label>
                <select id="aanhef" name="aanhef" class="form-control" required>
                    <option disabled selected></option>
                    <option value="dhr" <?= get_form_field('aanhef') === "dhr" ? "selected" : ""; ?>>Dhr</option>
                    <option value="mvr" <?= get_form_field('aanhef') === "mvr" ? "selected" : ""; ?>>Mvr</option>
                </select>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="row">
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="form-group">
                <label for="Naam">Naam</label>
                <input type="text" id="naam" name="naam" class="form-control" placeholder="Naam"
                       value="<?= get_form_field('naam') ?>" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="form-group">
                <label for="Achternaam">Achternaam</label>
                <input type="text" id="achternaam" name="achternaam" class="form-control" placeholder="Achternaam"
                       value="<?= get_form_field('achternaam') ?>" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="form-group">
                <label for="Tussenvoegsel">Tussenvoegsel</label>
                <input type="text" id="tussenvoegsel" name="tussenvoegsel" class="form-control"
                       value="<?= get_form_field('tussenvoegsel') ?>" placeholder="Tussenvoegsel">
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="form-group">
                <label for="Bedrijfsnaam">Bedrijfsnaam</label>
                <input type="text" id="bedrijfsnaam" name="bedrijfsnaam" class="form-control"
                       value="<?= get_form_field('bedrijfsnaam') ?>" placeholder="Bedrijfsnaam">
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="E-mail"
                       value="<?= get_form_field('email') ?>" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="form-group">
                <label for="telefoonnummer">Telefoonnummer</label>
                <input type="text" id="telefoonnummer" name="telefoonnummer" class="form-control"
                       value="<?= get_form_field('telefoonnummer') ?>" placeholder="Telefoonnummer" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="form-group">
                <label for="straat">Straat</label>
                <input type="text" id="straat" name="straat" class="form-control" placeholder="Straat"
                       value="<?= get_form_field('straat') ?>" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="form-group">
                <label for="huisnummer">Huisnummer</label>
                <input type="text" id="huisnummer" name="huisnummer" class="form-control" placeholder="Huisnummer"
                       value="<?= get_form_field('huisnummer') ?>" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="form-group">
                <label for="postcode">Postcode</label>
                <input type="text" id="postcode" name="postcode" class="form-control" placeholder="Postcode"
                       value="<?= get_form_field('postcode') ?>" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="form-group">
                <label for="woonplaats">Woonplaats</label>
                <input type="text" id="woonplaats" name="woonplaats" class="form-control" placeholder="Woonplaats"
                       value="<?= get_form_field('woonplaats') ?>" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="row">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Plaats bestelling</button>
            </div>
        </div>
    </div>


</form>
