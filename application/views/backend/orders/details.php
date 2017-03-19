<h2>Order <?= html_escape($order['id']) ?></h2>

<hr/>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Geplaatst</th>
        <th>Totaal</th>
        <th>Naam</th>
        <th>Email</th>
        <th>Telefoonnummer</th>
        <th>Straat</th>
        <th>Huisnummer</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= html_escape($order["geplaatst"]) ?></td>
        <td><?= html_escape($order["total_price"]) ?></td>
        <td><?= html_escape($order["aanhef"]) . " " . html_escape($order["naam"]) . " " . html_escape($order["tussenvoegsel"]) . " " . html_escape($order["achternaam"]) ?></td>
        <td><?= html_escape($order["email"]) ?></td>
        <td><?= html_escape($order["telefoonnummer"]) ?></td>
        <td><?= html_escape($order["straat"]) ?></td>
        <td><?= html_escape($order["huisnummer"]) ?></td>
    </tr>
    </tbody>
    <thead>
    <tr>
        <th>Postcode</th>
        <th>Woonplaats</th>
        <th>Bedrijfsnaam</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= html_escape($order["postcode"]) ?></td>
        <td><?= html_escape($order["woonplaats"]) ?></td>
        <td><?= html_escape($order["bedrijfsnaam"]) ?></td>
    </tr>
    </tbody>
</table>

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
    <? foreach ($order_products as $key => $cart_item): ?>
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
            <a class="btn btn-info" href="/backend/orders">
                Terug
            </a>
        </td>
        <td>
        </td>
        <td>
            Totaal:
        </td>
        <td>
            <?php echo $order['total_price']; ?>
        </td>
    </tr>
    </tbody>
</table>