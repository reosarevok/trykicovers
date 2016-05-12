<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/search.php"; ?>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <h2 id="search-head">Search</h2>
        <form id="search" action="system/search_results.php" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" />
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input class="form-control" type="text" name="author" id="author" />
            </div>
            <fieldset class="form-group">
                <legend class="checkbox-head">For which products?</legend>
                <div class="checkboxes hidden">
                    <?php foreach ($products as $product): ?>
                        <div class="checkbox-inline">
                            <input type="checkbox" name="tag[]" id="<?= $product['tag'] ?>" value="<?= $product['tag_id'] ?>">
                            <label for="<?= $product['tag'] ?>"><?= $product['tag'] ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <legend class="checkbox-head">What width?</legend>
                <div class="checkboxes hidden">
                    <?php foreach ($widths as $width): ?>
                        <div class="checkbox-inline">
                            <input type="checkbox" name="widths[]" id="<?= $width['tag'] ?>" value="<?= $width['tag_id'] ?>">
                            <label for="<?= $width['tag'] ?>"><?= $width['tag'] ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <legend class="checkbox-head">What height?</legend>
                <div class="checkboxes hidden">
                    <?php foreach ($heights as $height): ?>
                        <div class="checkbox-inline">
                            <input type="checkbox" name="heights[]" id="<?= $height['tag'] ?>" value="<?= $height['tag_id'] ?>">
                            <label for="<?= $height['tag'] ?>"><?= $height['tag'] ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <legend class="checkbox-head">What thickness?</legend>
                <div class="checkboxes hidden">
                    <?php foreach ($thicknesses as $thickness): ?>
                        <div class="checkbox-inline">
                            <input type="checkbox" name="thicknesses[]" id="<?= $thickness['tag'] ?>" value="<?= $thickness['tag_id'] ?>" >
                            <label for="<?= $thickness['tag'] ?>"><?= $thickness['tag'] ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <legend class="checkbox-head">In which language?</legend>
                <div class="checkboxes hidden">
                    <?php foreach ($languages as $language): ?>
                        <div class="checkbox-inline">
                            <input type="checkbox" name="tag[]" id="<?= $language['tag'] ?>" value="<?= $language['tag_id'] ?>">
                            <label for="<?= $language['tag'] ?>"><?= $language['tag'] ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <legend class="checkbox-head">From what material?</legend>
                <div class="checkboxes hidden">
                    <?php foreach ($materials as $material): ?>
                        <div class="checkbox-inline">
                            <input type="checkbox" name="tag[]" id="<?= $material['tag'] ?>" value="<?= $material['tag_id'] ?>">
                            <label for="<?= $material['tag'] ?>"><?= $material['tag'] ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
            <div class="form-group">
                <label for="colors">Colors:</label>
                <select multiple data-role="tagsinput" name="tag[]" id="colors"></select>
            </div>
            <div class="form-group">
                <label for="themes">Themes:</label>
                <select multiple data-role="tagsinput" name="tag[]" id="themes"></select>
            </div>
            <button type="submit" class="btn btn-default">Enter</button>
        </form>
    </div>
    <div class="col-xs-12 col-sm-8 col-sm-offset-2" id="results">
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.tt-input').keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
            }
        });

        $('.checkbox-head').click(function(){
            $(this).siblings('.checkboxes').toggleClass('hidden');
        });

        $('#search-head').click(function(){
            $('#search').toggleClass('hidden');
        });

        $("#search").submit(function( event ) {
            var data = $(this).serializeArray();
            event.preventDefault();
            $("#results").load("system/search_results.php", data);
            $('#search').addClass('hidden');
        });
    });

    /* tags-input */
    var themes = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('tag'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: <?= json_encode($themes) ?>
    });
    themes.initialize();

    $('#themes').tagsinput({
        confirmKeys: [13, 188],
        itemValue: 'tag_id',
        itemText: 'tag',
        typeaheadjs: [{
            hint: false
        },{
            name: 'themes',
            displayKey: 'tag',
            source: themes.ttAdapter()
        }]
    });
    var colors = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('tag'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: <?= json_encode($colors) ?>
    });
    themes.initialize();

    $('#colors').tagsinput({
        confirmKeys: [13, 188],
        itemValue: 'tag_id',
        itemText: 'tag',
        typeaheadjs: [{
            hint: false
        },{
            name: 'colors',
            displayKey: 'tag',
            source: colors.ttAdapter()
        }]
    });

</script>