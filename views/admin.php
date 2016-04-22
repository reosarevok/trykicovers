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
                <input class="form-control" type="text" name="title" id="title" />
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input class="form-control" type="text" name="author" id="author" />
            </div>
            <div class="form-group">
                <label for="shelf">Shelf</label>
                <select class="form-control" name="shelf" id="shelf">
                    <?php foreach ($shelves as $shelf): ?>
                        <option value="<?= $shelf['shelf_id'] ?>"><?= $shelf['shelf'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tags">Tags:</label>
                <input type="text" data-role="tagsinput" name="tags" id="tags" />
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
    var tags = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('tag'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: <?= json_encode($tags) ?>
    });
    tags.initialize();

    $('#tags').tagsinput({
        tagClass: function(item) {
            switch (item.tag_type) {
                case 'Colors'   : return 'label label-primary';
                case 'Materials': return 'label label-danger label-important';
                case 'Themes'   : return 'label label-success';
                case 'Products' : return 'label label-default';
                case 'Measures' : return 'label label-warning';
                case 'Languages': return 'label label-info';
            }
        },
        confirmKeys: [13, 188],
        itemValue: 'tag_id',
        itemText: 'tag',
        typeaheadjs: [{
            hint: false
        },{
            name: 'tags',
            displayKey: 'tag',
            source: tags.ttAdapter()
        }]
    });

</script>