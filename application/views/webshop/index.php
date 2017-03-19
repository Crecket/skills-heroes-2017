<h2>Webshop</h2>
<p>Selecteer een categorie:</p>

<div class="row">
    <?php $counter = 0; ?>
    <? foreach ($categories as $key => $category): ?>
        <div class="col-md-4">
            <a href="/webshop/category/<?= $category["url"] ?>">
                <b><?= html_escape($category["title"]) ?></b>
            </a>
            <p><?= html_escape($category["description"]) ?></p>
        </div>

        <!-- Make sure we don't get clipping -->
        <?php $counter++; ?>
        <?php if ($counter % 3 === 0): ?>
            <div class="col-md-12"></div>
        <?php endif; ?>
    <? endforeach; ?>
</div>