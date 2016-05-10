<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/shelf.php"; ?>

<div class="row">
    <div class="col-xs-12">
        <h3 class="text-center"><?= $shelf['shelf'] . ' (' . $shelf['shelf_size'] . ')' ?></h3>

        <div class="text-center" id="covers">
            <?php if (!empty($covers)) {
                echo "<h4>Covers</h4>";
                foreach ($covers as $cover) {
                    $id = $cover['cover_id'];
                    display_cover($id);
                }
            } else {
                echo "<p>No covers on this shelf</p>";
            } ?>
        </div>
    </div>
</div>