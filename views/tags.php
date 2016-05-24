<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/tags.php"; ?>

<?php if (count($tags) > 0): ?>
    <?php foreach ($tags as $tag_type => $tag_list): ?>
    <div class="row">
        <h4 class="text-center"><?= $tag_type ?></h4>
        <ul class="list-group">
            <?php foreach ($tag_list as $tag): ?>
            <li class="list-group-item col-xs-6 col-sm-3"> <a href="tag.php?id=<?= $tag['tag_id'] ?>"><?= $tag['tag'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<div class="row">
    <a href="add_tag.php"><h2 class="text-center">Add more tags</h2></a>
</div>