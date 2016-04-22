<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/cover.php"; ?>

<div class="row">
    <div class="col-xs-12">
        <?php if ((!empty($cover['title'])) && (!empty($cover['author']))): ?>
            <h3 class="text-center"><?= $cover['title'] . ' by ' . $cover['author'] ?></h3>
        <?php elseif (!empty($cover['title'])): ?>
            <h3 class="text-center"><?= $cover['title'] ?></h3>
        <?php else: ?>
            <h3 class="text-center">Cover</h3>
        <?php endif; ?>

        <?php $source = 'static/images/' . $cover['image_uuid'] . '.' . $cover['image_file_type']; ?>
        <img class="center-block" src="<?= $source ?>" />

        <div class="text-center" id="tags">
            <h4>Tags</h4>
            <ul class="list-group">
                <?php foreach ($tags as $tag): ?>
                    <li class="list-group-item col-xs-6 col-sm-3"> <?= $tag['tag'] ?> </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>