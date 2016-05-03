<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/front.php"; ?>

<?php if (count($covers) > 0): ?>
<div class="row">
    <div class="col-xs-12">
        <table class="table">
            <tbody>
            <tr>
            <?php

            $count = 0;
            foreach ($covers as $cover) {
                echo "<td>";
                display_cover($cover['cover_id']);
                echo "</td>";
                $count++;
                if ($count >= 3) {
                    echo "</tr><tr>";
                    $count = 0;
                }
            } ?>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>