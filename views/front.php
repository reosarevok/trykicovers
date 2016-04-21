<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/front.php"; ?>

<?php if (count($covers) > 0): ?>
<div class="row">
    <div class="col-xs-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($covers as $cover): array_map('htmlentities', $cover); ?>
                <tr>
                    <td><?= $cover["title"] ?></td>
                    <td><?= $cover["name"] ?></td>
                    <td><?= $cover["price"] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>