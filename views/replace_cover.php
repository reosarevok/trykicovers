<?php require $_SERVER['DOCUMENT_ROOT'] . "/trykicovers/controllers/replace_cover.php"; ?>

<?php if (empty($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <h2 class="text-center">Change cover image</h2>
        <div class="row image">
            <?php $source = 'static/images/' . $cover['image_uuid'] . '-thumb.jpg'; ?>
            <img class="center-block small-image cover_image" src="<?= $source ?>"/>
        </div>
        <form enctype="multipart/form-data" action="system/replace_cover.php" method="post">
            <div class="form-group">
                <input type="hidden" name="MAX_FILE_SIZE" value="100000000"/>
                <label for="cover_image">New cover</label>
                <input class="form-control" name="cover_image" id="cover_image" type="file"/>
            </div>
            <input type="hidden" name="id" value="<?= $cover['cover_id'] ?>">
            <input type="hidden" name="uuid" value="<?= $cover['image_uuid'] ?>">
            <button type="submit" class="btn btn-default">Enter</button>
        </form>
    </div>
</div>
