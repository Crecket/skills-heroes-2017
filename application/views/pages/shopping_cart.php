<h2>Winkelwagen</h2>
<?php if (count($shopping_cart) === 0): ?>
    <p>Uw winkelwagen is nog leeg!</p>
    <a href="/webshop" class="btn btn-info">
        Terug naar de webshop
    </a>
<?php else: ?>
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
            <td class="cart_image_col">
                <img alt="<?= html_escape($cart_item['name']) ?>" class="media-object cart_image"
                     src="/files/products/<?= $cart_item['id']; ?>.jpg">
            </td>
            <td>
                <h4 class="media-heading"><?= $cart_item['name'] ?></h4>
                <small><?= $cart_item['description'] ?></small>
            </td>
            <td>
                <form id="amount-form<?= $cart_item['id'] ?>" class="amount-selector-form"
                      method="POST" action="/shoppingcart/set/<?= $cart_item['id'] ?>">
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>

                    <input type="number" value="<?= html_escape($cart_item['amount']) ?>"
                           id="cart_item_input<?= $cart_item['id'] ?>"
                           class="form-control amount-selector" name="amount" data-id="<?= $cart_item['id'] ?>">
                    x €<?= html_escape($cart_item['price']) ?>
                </form>
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
            <a href="/webshop/order" class="btn btn-info">
                Bestellen
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
<?php endif; ?>