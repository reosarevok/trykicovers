<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/add_tag.php"; ?>

<?php if (empty($_SESSION['user_id']))
{
header( "Location: login.php" );
}
?>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <h2 class="text-center">Add tag</h2>

        <form action="system/add_tag.php" method="post">

            <div class="form-group">
                <label for="tag_type">Tag type</label>
                <select class="form-control" name="tag_type" id="tag_type">
                    <?php foreach ($tag_types as $tag_type): ?>
                        <option value="<?= $tag_type['tag_type_id'] ?>"><?= $tag_type['tag_type'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="tag">Tag name</label>
                <input class="form-control" type="text" name="tag" id="tag" required />
            </div>

            <button type="submit" class="btn btn-default">Enter</button>
        </form>
    </div>
 </div>