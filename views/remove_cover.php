<?php require $_SERVER['DOCUMENT_ROOT'] . "/trykicovers/controllers/remove_cover.php"; ?>

<?php if (empty($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>

<?php if (empty($cover)): ?>
    <h4 class="text-center">No ID provided or no cover found with that ID</h4>

<?php else: ?>

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <h2 class="text-center">Remove cover?</h2>

            <div class="row title">
                <?php if (!empty($cover->author)): ?>
                    <h3 class="text-center"><?= $cover->title . ' by ' . $cover->author ?></h3>
                <?php else: ?>
                    <h3 class="text-center"><?= $cover->title ?></h3>
                <?php endif; ?>
            </div>

            <div class="row image">
                <?php $source = 'static/images/' . $cover->image_uuid . '-thumb.jpg'; ?>
                <img class="center-block small-image cover_image" src="<?= $source ?>"/>
            </div>

            <div class="row delete-button text-center">
                <a class="btn btn-danger" role="button" href="system/remove_cover.php?id=<?= $cover->cover_id ?>">Yes,
                    remove this!</a>
            </div>
        </div>
    </div>

<?php endif; ?>