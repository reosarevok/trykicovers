<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/tag.php"; ?>

<div class="row">
    <div class="col-xs-12">
        <h3 class="text-center"><?= $tag->fetch()->tag . ' (' . $tag->tag_type()->fetch()->tag_type . ')' ?></h3>

        <div class="text-center" id="covers">
            <?php if (!empty($covers->fetch())) {
                echo "<h4>Covers</h4>";
                foreach ($covers as $cover) {
                    if ($cover->amount > 0) {
                        display_cover($cover);
                    }                }
            } else {
                echo "<p>No covers with this tag</p>";
            } ?>
        </div>
    </div>
</div>