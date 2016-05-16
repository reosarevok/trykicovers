<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/tag.php"; ?>

<div class="row">
    <div class="col-xs-12">
        <h3 class="text-center"><?= $tag['tag'] . ' (' . $tag['tag_type'] . ')' ?></h3>

        <div class="text-center" id="covers">
            <?php if (!empty($covers)) {
                echo "<h4>Covers</h4>";
                foreach ($covers as $cover) {
                    $id = $cover['cover_id'];
                    if ($cover['amount'] > 0) {
                        display_cover($id);
                    }                }
            } else {
                echo "<p>No covers with this tag</p>";
            } ?>
        </div>
    </div>
</div>