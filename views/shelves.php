<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/shelves.php"; ?>

<?php if (count($shelves) > 0): ?>
<div class="row">
    <ul class="list-group">
        <?php foreach ($shelves as $shelf): ?>
            <li class="list-group-item col-xs-6 col-sm-3">
                <a href="shelf.php?id=<?= $shelf->shelf_id ?>"><?= $shelf->shelf()->fetch()->shelf ?> (<?= $shelf->cover_amount . "/" . $shelf->shelf()->fetch()->shelf_size ?>)</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>