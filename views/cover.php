<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/cover.php"; ?>

<?php if (empty($cover)): ?>

<h4 class="text-center">No cover found with this ID!</h4>

<?php else: ?>

<div class="row">
    <div class="col-xs-12">

        <div class="row title">
        <?php if (!empty($cover['author'])): ?>
            <h3 class="text-center"><?= $cover['title'] . ' by ' . $cover['author'] ?></h3>
        <?php else: ?>
            <h3 class="text-center"><?= $cover['title'] ?></h3>
        <?php endif; ?>
        </div>


        <?php if (!empty($cover['translated_title'])): ?>
        <div class="row translated_title">
            <h4 class="text-center">(<?= $cover['translated_title'] ?>)</h4>
        </div>
        <?php endif; ?>

        <?php if (!empty($cover['comment'])): ?>
        <div class="row comment">
            <p class="text-center">(<?= $cover['comment'] ?>)</p>
        </div>
        <?php endif; ?>

        <div class="row image">
            <?php $source = 'static/images/' . $cover['image_uuid'] . '-thumb.jpg'; ?>
            <img class="center-block small-image cover_image" src="<?= $source ?>" />
        </div>

        <div class="text-center" id="shelf">
            <h4>Located on shelf <?= $cover['shelf'] ?></h4>
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

        <div class="col-xs-12 text-center" id="tags">
            <div class="row"><h4>Tags</h4></div>
            <div class="row">
                <ul class="list-group">
                    <?php foreach ($tags as $tag): ?>
                        <li class="list-group-item col-xs-6 col-sm-3"> <a href="tag.php?id=<?= $tag['tag_id'] ?>"><?= $tag['tag'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<script>
    $(document).ready(function() {
       $('.cover_image').click(function() {
           if ($(this).hasClass('small-image')) {
               $(this).attr("src", "<?= 'static/images/' . $cover['image_uuid'] . '.jpg'; ?>");
               $(this).removeClass('small-image');
           } else {
               $(this).attr("src", "<?= 'static/images/' . $cover['image_uuid'] . '-thumb.jpg'; ?>");
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
        $.ajax({
            type: "post",
            url: "system/update_amount.php",
            data: { amount: amount, cover_id: <?= $cover['cover_id'] ?> }
        }).success(function (data) {
            console.log(data);
            console.log(field);
            $("#" + field + "").val(data);
        });
    }

</script>