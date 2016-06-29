<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/edit_cover.php"; ?>

<?php if (empty($cover)): ?>
    <h4 class="text-center">No ID provided or no cover found with that ID</h4>

<?php else: ?>

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <h2 class="text-center">Edit cover</h2>
            <div class="row image">
                <?php $source = 'static/images/' . $cover['image_uuid'] . '-thumb.jpg'; ?>
                <img class="center-block small-image cover_image" src="<?= $source ?>" />
            </div>
            <form action="system/edit_cover.php" method="post">
                <input type="hidden" name="cover_id" value="<?= $cover['cover_id'] ?>">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title" id="title" value="<?= $cover['title'] ?>" required />
                </div>

                <?php if (empty($cover['transliterated_title'])): ?>
                    <div class="form-group hidden" id="title_transliteration_div">
                        <label for="title_transliteration">Transliterated title</label>
                        <input class="form-control" type="text" name="title_transliteration" id="title_transliteration" />
                    </div>
                <?php else: ?>
                    <div class="form-group" id="title_transliteration_div">
                        <label for="title_transliteration">Transliterated title</label>
                        <input class="form-control" type="text" name="title_transliteration" id="title_transliteration" value="<?= $cover['transliterated_title'] ?>" />
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="translation">Translated title</label>
                    <input class="form-control" type="text" name="translation" id="translation" value="<?= $cover['translated_title'] ?>" />
                </div>

                <div class="form-group">
                    <label for="author">Author</label>
                    <input class="form-control" type="text" name="author" id="author" value="<?= $cover['author'] ?>" />
                </div>

                <?php if (empty($cover['transliterated_author'])): ?>
                    <div class="form-group hidden" id="author_transliteration_div">
                        <label for="author_transliteration">Transliterated title</label>
                        <input class="form-control" type="text" name="author_transliteration" id="author_transliteration" />
                    </div>
                <?php else: ?>
                    <div class="form-group" id="author_transliteration_div">
                        <label for="author_transliteration">Transliterated title</label>
                        <input class="form-control" type="text" name="author_transliteration" id="author_transliteration" value="<?= $cover['transliterated_author'] ?>" />
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="comment">Comments</label>
                    <input class="form-control" type="text" name="comment" id="comment" value="<?= $cover['comment'] ?>" />
                </div>

                <div class="form-group">
                    <label for="shelf">Shelf</label>
                    <select class="form-control" name="shelf" id="shelf">
                        <?php foreach ($shelves as $shelf): ?>
                            <option value="<?= $shelf['shelf_id'] ?>" <?= $shelf['shelf_id'] == $cover['shelf_id'] ? "selected" : '' ?>><?= $shelf['shelf'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <fieldset class="form-group">
                    <legend class="checkbox-head">For which products?</legend>
                    <div class="checkboxes">
                        <?php foreach ($products as $product): ?>
                            <div class="checkbox-inline">
                                <input type="checkbox" name="products[]" id="<?= $product['tag'] ?>" value="<?= $product['tag_id'] ?>" <?= in_array($product['tag_id'], $tags) ? "checked" : '' ?>>
                                <label for="<?= $product['tag'] ?>"><?= $product['tag'] ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </fieldset>

                <fieldset class="form-group">
                    <legend class="checkbox-head">What's the width?</legend>
                    <div class="checkboxes">
                        <?php foreach ($widths as $width): ?>
                            <div class="radio-inline">
                                <input type="radio" name="widths[]" id="<?= $width['tag'] ?>" value="<?= $width['tag_id'] ?>" <?= in_array($width['tag_id'], $tags) ? "checked" : '' ?> required>
                                <label for="<?= $width['tag'] ?>"><?= $width['tag'] ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </fieldset>

                <fieldset class="form-group">
                    <legend class="checkbox-head">What's the height?</legend>
                    <div class="checkboxes">
                        <?php foreach ($heights as $height): ?>
                            <div class="radio-inline">
                                <input type="radio" name="heights[]" id="<?= $height['tag'] ?>" value="<?= $height['tag_id'] ?>" <?= in_array($height['tag_id'], $tags) ? "checked" : '' ?> required>
                                <label for="<?= $height['tag'] ?>"><?= $height['tag'] ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </fieldset>

                <fieldset class="form-group">
                    <legend class="checkbox-head">What's the thickness?</legend>
                    <div class="checkboxes">
                        <?php foreach ($thicknesses as $thickness): ?>
                            <div class="radio-inline">
                                <input type="radio" name="thicknesses[]" id="<?= $thickness['tag'] ?>" value="<?= $thickness['tag_id'] ?>" <?= in_array($thickness['tag_id'], $tags) ? "checked" : '' ?> required>
                                <label for="<?= $thickness['tag'] ?>"><?= $thickness['tag'] ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </fieldset>

                <fieldset class="form-group">
                    <legend class="checkbox-head">In which language?</legend>
                    <div class="checkboxes">
                        <?php foreach ($languages as $language): ?>
                            <div class="checkbox-inline">
                                <input type="checkbox" name="languages[]" id="<?= $language['tag'] ?>" value="<?= $language['tag_id'] ?>" <?= in_array($language['tag_id'], $tags) ? "checked" : '' ?>>
                                <label for="<?= $language['tag'] ?>"><?= $language['tag'] ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </fieldset>

                <fieldset class="form-group">
                    <legend class="checkbox-head">From what material?</legend>
                    <div class="checkboxes">
                        <?php foreach ($materials as $material): ?>
                            <div class="checkbox-inline">
                                <input type="checkbox" name="materials[]" id="<?= $material['tag'] ?>" value="<?= $material['tag_id'] ?>" <?= in_array($material['tag_id'], $tags) ? "checked" : '' ?>>
                                <label for="<?= $material['tag'] ?>"><?= $material['tag'] ?></label>
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

        var used_themes = <?= json_encode($used_themes) ?>;
        console.log(used_themes);
        used_themes.forEach(function (theme) {
            $('#themes').tagsinput('add', { "tag_id": theme['tag_id'] , "tag": theme['tag'] });
        })

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

        var used_colors = <?= json_encode($used_colors) ?>;
        console.log(used_colors);
        used_colors.forEach(function (color) {
            $('#colors').tagsinput('add', { "tag_id": color['tag_id'] , "tag": color['tag'] });
        });


        $("#add-theme").click(function() {
            var newTheme = $(".tt-input").eq(1).typeahead('val');
            var confirm = window.confirm("You want to add a new theme '" + newTheme + "'?");
            if (confirm) {
                $.ajax({
                    type: "post",
                    url: "system/add_tag.php",
                    data: { tag: newTheme, tag_type: 5 }
                }).success(function (data) {
                    $('#themes').tagsinput('add', { "tag_id": data , "tag": newTheme });
                });
            }

        });

    </script>

<?php endif; ?>