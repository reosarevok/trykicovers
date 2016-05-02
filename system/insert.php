<?php
require_once "database.php";

if(!isset($_FILES['cover_image']))
{
    echo '<p>Please select a file</p>';
}
else
{
    try    {
        if (!empty($_POST)) {
            $new_id = add_cover($_POST["title"], $_POST["author"], 1, $_POST["shelf"]);
            $tags = $_POST["tag"];
            foreach ($tags as $tag) {
                add_tag_to_cover($tag, $new_id);
            }
            $imageFileType = pathinfo($_FILES['cover_image']['name'],PATHINFO_EXTENSION);
            $uuid = add_cover_image($new_id, $imageFileType);
            upload_file($uuid);

            echo "Upload succesful! See the <a href='../cover.php?id=$new_id'>newly uploaded cover</a> or
                <a href='../admin.php'>upload more covers</a>";
        }
        else {
            echo '<h4>Please add some data</h4>';
        }
    }
    catch(Exception $e)
    {
        echo '<h4>'.$e->getMessage().'</h4>';
    }
}

function upload_file($uuid) {
    if(is_uploaded_file($_FILES['cover_image']['tmp_name']) && getimagesize($_FILES['cover_image']['tmp_name']) != false)
    {
        $imageFileType = pathinfo($_FILES['cover_image']['name'],PATHINFO_EXTENSION);
        $image_dir = dirname(getcwd()).'/static/images';

        move_uploaded_file($_FILES['cover_image']['tmp_name'], "$image_dir/$uuid.$imageFileType");
        return "$uuid.$imageFileType";
    }
};