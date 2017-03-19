<h2>Producten</h2>
<a href="backend/products/add" class="btn btn-primary btn-xs">
    <i class="fa fa-plus"></i> Toevoegen
</a>
<hr/>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th></th>
        <th>Product</th>
        <th>Categorie</th>
        <th>Prijs</th>
        <th>Acties</th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($products as $product): ?>
        <tr>
            <td><img src="/files/products/<?= $product['id'] ?>.jpg" style="max-height: 40px;"></td>
            <td><?= html_escape($product["name"]) ?></td>
            <td><?= html_escape($product["category_title"]) ?></td>
            <td><?= html_escape($product["price"]) ?></td>
            <td>
                <a href="backend/products/edit/<?= $product["id"] ?>" class="btn btn-primary btn-xs">
                    <i class="fa fa-pencil"></i> Bewerken
                </a>
                <a href="backend/products/remove/<?= $product["id"] ?>" class="btn btn-danger btn-xs">
                    <i class="fa fa-trash"></i> Verwijder
                </a>
            </td>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>