<?php require $_SERVER['DOCUMENT_ROOT'] . "/trykicovers/controllers/shelf.php"; ?>

<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <h3 class="text-center"><?= $shelf->shelf . ' (' . $shelf->shelf_size . ')' ?></h3>
        </div>

        <div class="text-center" id="covers">

            <?php if (!empty($covers)): ?>
                <?php foreach ($covers as $cover): ?>
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <?php $id = $cover->cover_id;
                            if ($cover->amount > 0) {
                                display_cover($cover);
                            } ?>
                        </div>
                        <div class="col-xs-12 col-md-2 text-center">
                            <div class="row title">
                                <?php if (!empty($cover->author)): ?>
                                    <h3 class="text-center"><?= $cover->title . ' by ' . $cover->author ?></h3>
                                <?php else: ?>
                                    <h3 class="text-center"><?= $cover->title ?></h3>
                                <?php endif; ?>
                            </div>
                            <div class="input-group row">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-danger btn-number" data-type="minus"
                                            data-field="amount-<?= $id ?>" data-cover-id="<?= $id ?>">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                </span>
                                <input type="text" name="amount-<?= $id ?>" id="amount-<?= $id ?>"
                                       class="form-control input-number text-center" value="<?= $cover->amount ?>"
                                       min="0" readonly/>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success btn-number" data-type="plus"
                                            data-field="amount-<?= $id ?>" data-cover-id="<?= $id ?>">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                echo "<p>No covers on this shelf</p>";
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    $('.btn-number').click(function (event) {
        event.preventDefault();

        var fieldName = $(this).attr('data-field');
        var type = $(this).attr('data-type');
        var cover_id = $(this).attr('data-cover-id');
        var input = $("input[name='" + fieldName + "");
        var currentVal = parseInt(input.val());
        console.log(newVal, fieldName, cover_id);
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    var newVal = currentVal - 1;
                    update_amount(newVal, fieldName, cover_id);
                }

            } else if (type == 'plus') {
                var newVal = currentVal + 1;
                update_amount(newVal, fieldName, cover_id);

            }
        } else {
            input.val(0);
        }
    });

    function update_amount(amount, field, cover_id) {
        $.ajax({
            type: "post",
            url: "system/update_amount.php",
            data: {amount: amount, cover_id: cover_id}
        }).done(function (data) {
            $("#" + field + "").val(data);
        });
    }
</script>