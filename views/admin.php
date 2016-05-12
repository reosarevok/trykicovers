<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/admin.php"; ?>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <h2>Add cover</h2>
        <form enctype="multipart/form-data" action="system/insert.php" method="post">
            <div class="form-group">
                <input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
                <label for="cover_image">Cover</label>
                <input class="form-control" name="cover_image" id="cover_image" type="file" />
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" required />
            </div>
            <div class="form-group">
                <label for="translation">Translated title</label>
                <input class="form-control" type="text" name="translation" id="translation" />
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input class="form-control" type="text" name="author" id="author" />
            </div>
            <div class="form-group">
                <label for="comment">Comments</label>
                <input class="form-control" type="text" name="comment" id="comment" />
            </div>
            <div class="form-group">
                <label for="shelf">Shelf</label>
                <select class="form-control" name="shelf" id="shelf">
                    <?php foreach ($shelves as $shelf): ?>
                        <option value="<?= $shelf['shelf_id'] ?>"><?= $shelf['shelf'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <fieldset class="form-group">
                <legend class="checkbox-head">For which products?</legend>
                <div class="checkboxes">
                    <?php foreach ($products as $product): ?>
                        <div class="checkbox-inline">
                            <input type="checkbox" name="products[]" id="<?= $product['tag'] ?>" value="<?= $product['tag_id'] ?>">
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
                            <input type="radio" name="widths[]" id="<?= $width['tag'] ?>" value="<?= $width['tag_id'] ?>" required>
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
                            <input type="radio" name="heights[]" id="<?= $height['tag'] ?>" value="<?= $height['tag_id'] ?>" required>
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
                            <input type="radio" name="thicknesses[]" id="<?= $thickness['tag'] ?>" value="<?= $thickness['tag_id'] ?>" required>
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
                            <input type="checkbox" name="languages[]" id="<?= $language['tag'] ?>" value="<?= $language['tag_id'] ?>">
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
                            <input type="checkbox" name="materials[]" id="<?= $material['tag'] ?>" value="<?= $material['tag_id'] ?>">
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
                <label for="themes">Themes:</label>
                <select multiple data-role="tagsinput" name="themes[]" id="themes"></select>
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