<h2>Categorieën</h2>
<a href="backend/categories/add" class="btn btn-primary btn-xs">
    <i class="fa fa-plus"></i> Toevoegen
</a>
<hr/>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Titel</th>
        <th>Url</th>
        <th>Acties</th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($categories as $category): ?>
        <tr>
            <td><?= html_escape($category["title"]) ?></td>
            <td><a href="/webshop/category/<?= html_escape($category['url'])?>"><?= html_escape($category["url"]) ?></a></td>
            <td>
                <a href="backend/categories/edit/<?= $category["id"] ?>" class="btn btn-primary btn-xs">
                    <i class="fa fa-pencil"></i> Bewerken
                </a>
                <a href="backend/categories/remove/<?= $category["id"] ?>" class="btn btn-danger btn-xs">
                    <i class="fa fa-trash"></i> Verwijder
                </a>
            </td>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>