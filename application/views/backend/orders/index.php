<h2>Orders</h2>

<hr/>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Geplaatst</th>
        <th>Totaal</th>
        <th>Naam</th>
        <th>Email</th>
        <th>Telefoonnummer</th>
        <th>Acties</th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($orders as $order): ?>
        <tr>
            <td><?= html_escape($order["geplaatst"]) ?></td>
            <td><?= html_escape($order["total_price"]) ?></td>
            <td><?= html_escape($order["aanhef"]) . " " . html_escape($order["naam"]) . " " . html_escape($order["tussenvoegsel"]) . " " . html_escape($order["achternaam"]) ?></td>
            <td><?= html_escape($order["email"]) ?></td>
            <td><?= html_escape($order["telefoonnummer"]) ?></td>
            <td>
                <a href="backend/orders/details/<?= $order["id"] ?>" class="btn btn-primary btn-xs">
                    <i class="fa fa-info"></i> Details
                </a>
            </td>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>