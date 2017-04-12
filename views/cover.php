<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/cover.php"; ?>

<?php if (empty($cover)): ?>

<h4 class="text-center">No cover found with this ID!</h4>

<?php else: ?>

<div class="row">
    <div class="col-xs-12">

        <div class="row title">
        <?php if (!empty($cover->author)): ?>
            <h3 class="text-center"><?= $cover->title . ' by ' . $cover->author ?></h3>
        <?php else: ?>
            <h3 class="text-center"><?= $cover->title ?></h3>
        <?php endif; ?>
        </div>

        <div class="row edit text-center">
            <a href="edit_cover.php?id=<?= $cover->cover_id ?>">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit data
            </a>
            <a id="remove_cover" href="remove_cover.php?id=<?= $cover->cover_id ?>">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove data
            </a>
            <a href="replace_cover.php?id=<?= $cover->cover_id ?>">
                <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Replace image
            </a>
        </div>

        <?php if (!empty($cover->transliterated_title) && !empty($cover->transliterated_author) ): ?>
            <div class="row translated_title">
                <h4 class="text-center">(<?= $cover->transliterated_title . ' by ' . $cover->transliterated_author ?>)</h4>
            </div>
        <?php elseif (!empty($cover->transliterated_title)): ?>
            <div class="row translated_title">
                <h4 class="text-center">(<?= $cover->transliterated_title ?>)</h4>
            </div>
        <?php endif; ?>

        <?php if (!empty($cover->translated_title)): ?>
        <div class="row translated_title">
            <h4 class="text-center">(<?= $cover->translated_title ?>)</h4>
        </div>
        <?php endif; ?>

        <?php if (!empty($cover->comment)): ?>
        <div class="row comment">
            <p class="text-center">(<?= $cover->comment ?>)</p>
        </div>
        <?php endif; ?>

        <div class="row image">
            <?php $source = 'static/images/' . $cover->image_uuid . '-thumb.jpg'; ?>
            <img class="center-block small-image cover_image" src="<?= $source ?>" />
        </div>

        <div class="text-center" id="shelf">
            <h4>Located on shelf <?= $cover->shelf()->fetch()->shelf ?></h4>
        </div>

        <div class="col-xs-12 col-md-2 col-md-offset-5 text-center">
            <div class="row"><h4>Amount</h4> </div>
            <div class="input-group row">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="amount">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                </span>
                <input type="text" name="amount" id="amount" class="form-control input-number text-center" value="<?= $cover['amount'] ?>" min="0" readonly />
                <span class="input-group-btn">
                    <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="amount">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </span>
            </div>
        </div>


            <div class="col-xs-12 col-md-2 col-md-offset-5 text-center">
                <div class="row"><h4>Reservations</h4> </div>
                <?php if (!(empty($reservations))): ?>
                    <h5>Reserved by:</h5>
                    <ul class="text-left">
                    <?php foreach ($reservations as $reservation): ?>
                        <?php if (empty($_SESSION['user_id']) or ($_SESSION['user_id'] != $reservation->user_id)): ?>
                            <?php $user = $db2->users()->where("id", $reservation->user_id)->fetch(); ?>
                            <li><?= $user->username ?> (<?= $reservation->amount ?>)</li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php if (!(empty($_SESSION['user_id']))): ?>
                    <h5>Reserved by me:</h5>
                    <div class="input-group row">
                        <span class="input-group-btn">
                            <button type="button" id="reservation-minus" class="btn btn-danger btn-number"  data-type="minus" data-field="reservation">
                                <span class="glyphicon glyphicon-minus"></span>
                            </button>
                        </span>
                        <input type="text" name="reservation" id="reservation" class="form-control input-number text-center" value="<?= $user_reservation->amount ?>" min="0" readonly />
                        <span class="input-group-btn">
                            <button type="button" id="reservation-plus" class="btn btn-success btn-number" data-type="plus" data-field="reservation">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
                    </div>
                <?php endif; ?>
            </div>


        <div class="col-xs-12" id="tags">
            <div class="row"><h3>Tags</h3></div>
            <?php foreach ($tags as $tag_type => $tag_list): ?>
                <?php if (!(empty($tag_list->fetch()))): ?>
                    <div class="row">
                        <h4 class=""><?= $tag_type ?></h4>
                        <ul class="list-group">
                            <?php foreach ($tag_list as $tag): ?>
                                <li class="list-group-item col-xs-6 col-sm-3"> <a href="tag.php?id=<?= $tag->tag_id ?>"><?= $tag->tag ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php endif; ?>

<script>
    $(document).ready(function() {
       $('.cover_image').click(function() {
           if ($(this).hasClass('small-image')) {
               $(this).attr("src", "<?= 'static/images/' . $cover->image_uuid . '.jpg'; ?>");
               $(this).removeClass('small-image');
           } else {
               $(this).attr("src", "<?= 'static/images/' . $cover->image_uuid . '-thumb.jpg'; ?>");
               $(this).addClass('small-image');
           }

       });
    });

    $('.btn-number').click(function(event){
        event.preventDefault();

        var fieldName = $(this).attr('data-field');
        var type      = $(this).attr('data-type');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {

                if(currentVal > input.attr('min')) {
                    var newVal = currentVal - 1;
                    update_amount(newVal, fieldName);
                }

            } else if(type == 'plus') {
                var newVal = currentVal + 1;
                update_amount(newVal, fieldName);

            }
        } else {
            input.val(0);
        }
    });

    function update_amount(amount, field) {
        if (field == "amount") {
            $.ajax({
                type: "post",
                url: "system/update_amount.php",
                data: {amount: amount, cover_id: <?= $cover->cover_id ?> }
            }).done(function (data) {
                $("#" + field + "").val(data);
            });
        }
        else if (field == "reservation") {
            $.ajax({
                type: "post",
                url: "system/update_reservation.php",
                data: {amount: amount, cover_id: <?= $cover->cover_id ?>, user_id: <?= $_SESSION["user_id"] ?> }
            }).done(function (data) {
                $("#" + field + "").val(data);
            });
        }
    }

</script>