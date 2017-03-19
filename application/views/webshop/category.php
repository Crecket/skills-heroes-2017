<h2>Categorie: <?= $category["title"] ?></h2>
<p><?= $category["description"] ?></p>
<hr/>
<div class="row">
    <? foreach ($products as $product): ?>
        <div class="col-md-4 product-holder">
            <b><?= $product["name"]; ?></b><br/><br/>
            <img src="/files/products/<?= $product["id"] ?>.jpg" class="img img-thumbnail"/>
            <p>&euro; <?= number_format($product["price"], 2, ",", ".") ?></p>
            <a href="/webshop/product/<?= $product["url"] ?>" class="btn btn-info btn-block">
                Bekijk product
            </a>
        </div>
    <? endforeach; ?>
</div>