<h2><?= $product["name"] ?></h2>
<div class="row">
    <div class="col-md-4">
        <img src="files/products/<?= $product["id"] ?>.jpg" class="img img-thumbnail product-photo"/>
    </div>
    <div class="col-md-8">
        <p><?= html_escape($product["description"]) ?></p>
        <table class="table">
            <tr>
                <td>Categorie:</td>
                <td>
                    <a href="index.php/webshop/category/<?= $category["url"] ?>/"><?= html_escape($category["title"]) ?></a>
                </td>
            </tr>
            <tr>
                <td>EAN:</td>
                <td><?= html_escape($product["ean"]); ?></td>
            </tr>
            <tr>
                <td>Prijs:</td>
                <td>&euro; <?= number_format($product["price"], 2, ",", ".") ?></td>
            </tr>
        </table>
        <form method="POST" action="/shoppingcart/set/<?= $product["id"] ?>" role="form" data-toggle="validator">
            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"/>
            <input type="hidden" name="id" value="<?= $product['id']; ?>"/>

            <div class="col-xs-6">
                <div class="row">
                    <label for="amount">Hoeveelheid:</label>
                    <input type="number" id="amount" name="amount" class="form-control"
                           value="1" step="1" min="1">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="row">
                    <button class="btn btn-info">
                        <i class="fa fa-shopping-cart"></i> Winkelwagen
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
