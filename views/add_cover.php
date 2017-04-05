<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/add_cover.php"; ?>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <h2 class="text-center">Add cover</h2>
        <form enctype="multipart/form-data" action="system/add_cover.php" method="post">
            <div class="form-group">
                <input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
                <label for="cover_image">Cover</label>
                <input class="form-control" name="cover_image" id="cover_image" type="file" />
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" required />
            </div>
            <div class="form-group hidden" id="title_transliteration_div">
                <label for="title_transliteration">Transliterated title</label>
                <input class="form-control" type="text" name="title_transliteration" id="title_transliteration" />
            </div>
            <div class="form-group">
                <label for="translation">Translated title</label>
                <input class="form-control" type="text" name="translation" id="translation" />
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input class="form-control" type="text" name="author" id="author" />
            </div>
            <div class="form-group hidden" id="author_transliteration_div">
                <label for="author_transliteration">Transliterated author</label>
                <input class="form-control" type="text" name="author_transliteration" id="author_transliteration" />
            </div>
            <div class="form-group">
                <label for="comment">Comments</label>
                <input class="form-control" type="text" name="comment" id="comment" />
            </div>
            <fieldset class="form-group">
                <legend class="checkbox-head">For which products?</legend>
                <div class="checkboxes">
                    <?php foreach ($products as $product): ?>
                        <div class="checkbox-inline">
                            <input type="checkbox" name="products[]" id="<?= $product->tag ?>" value="<?= $product->tag_id ?>">
                            <label for="<?= $product->tag ?>"><?= $product->tag ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <legend class="checkbox-head">What's the width?</legend>
                <div class="checkboxes">
                    <?php foreach ($widths as $width): ?>
                        <div class="radio-inline">
                            <input type="radio" name="widths[]" id="<?= $width->tag ?>" value="<?= $width->tag_id ?>" required <?= $width->tag == "12 to 14 cm" ? "checked" : '' ?>>
                            <label for="<?= $width->tag ?>"><?= $width->tag ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <legend class="checkbox-head">What's the height?</legend>
                <div class="checkboxes">
                    <?php foreach ($heights as $height): ?>
                        <div class="radio-inline">
                            <input type="radio" name="heights[]" id="<?= $height->tag ?>" value="<?= $height->tag_id ?>" required <?= $height->tag == "20 to 21 cm" ? "checked" : '' ?>>
                            <label for="<?= $height->tag ?>"><?= $height->tag ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <legend class="checkbox-head">What's the thickness?</legend>
                <div class="checkboxes">
                    <?php foreach ($thicknesses as $thickness): ?>
                        <div class="radio-inline">
                            <input type="radio" name="thicknesses[]" id="<?= $thickness->tag ?>" value="<?= $thickness->tag_id ?>" required <?= $thickness->tag == "2 to 3 cm" ? "checked" : '' ?>>
                            <label for="<?= $thickness->tag ?>"><?= $thickness->tag ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <legend class="checkbox-head">In which language?</legend>
                <div class="checkboxes">
                    <?php foreach ($languages as $language): ?>
                        <div class="checkbox-inline">
                            <input type="checkbox" name="languages[]" id="<?= $language->tag ?>" value="<?= $language->tag_id ?>">
                            <label for="<?= $language->tag ?>"><?= $language->tag ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <legend class="checkbox-head">From what material?</legend>
                <div class="checkboxes">
                    <?php foreach ($materials as $material): ?>
                        <div class="checkbox-inline">
                            <input type="checkbox" name="materials[]" id="<?= $material->tag ?>" value="<?= $material->tag_id ?>">
                            <label for="<?= $material->tag ?>"><?= $material->tag ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
            <div class="form-group">
                <label for="colors">Colors:</label>
                <select multiple data-role="tagsinput" name="colors[]" id="colors"></select>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <label for="themes">Themes:</label>
                    <select multiple data-role="tagsinput" name="themes[]" id="themes"></select>
                    <span class="btn btn-success" id="add-theme">Add a new theme!</span>
                </div>
            </div>
            <button type="submit" class="btn btn-default">Enter</button>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.tt-input').keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
            }
        });

        $("#title").blur(function() {
            var word = $(this).val();
            var title = transliteration.transliterate(word);
            if (word != title) {
                $('#title_transliteration').val(title);
                $('#title_transliteration_div').removeClass("hidden");
            }
        });

        $("#author").blur(function() {
            var word = $(this).val();
            var author = transliteration.transliterate(word);
            if (word != author) {
                $('#author_transliteration').val(author);
                $('#author_transliteration_div').removeClass("hidden");
            }
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

    $("#add-theme").click(function() {
        var newTheme = $(".tt-input").eq(1).typeahead('val');
        var confirm = window.confirm("You want to add a new theme '" + newTheme + "'?");
        if (confirm) {
            $.ajax({
                type: "post",
                url: "system/add_tag.php",
                data: { tag: newTheme, tag_type: 5 }
            }).done(function (data) {
                $('#themes').tagsinput('add', { "tag_id": data , "tag": newTheme });
            });
        }

    });

</script>
