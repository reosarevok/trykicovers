<?php
require_once "database.php";

if(!isset($_FILES['cover_image']) || !(is_uploaded_file($_FILES['cover_image']['tmp_name'])))
{
    echo '<p>Please select a file</p>';
}
else
{
    try    {
        if (!empty($_POST)) {
           echo insert_new_cover($_POST);
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

function insert_new_cover($params)
{
    $tags = Array();

    if (empty($params["products"])) {
        return "You must select at least one product!";
    } else {
        $tags = array_merge($tags, $params["products"]);
    }

    if (empty($params["measures"])) {
        return "You must select at least one measure!";
    } else {
        $tags = array_merge($tags, $params["measures"]);
    }

    if (empty($params["languages"])) {
        return "You must select at least one language!";
    } else {
        $tags = array_merge($tags, $params["languages"]);
    }

    if (empty($params["materials"])) {
        return "You must select at least one material!";
    } else {
        $tags = array_merge($tags, $params["materials"]);
    }

    if (empty($params["colors"])) {
        return "You must select at least one color!";
    } else {
        $tags = array_merge($tags, $params["colors"]);
    }

    if (!empty($params["themes"])) {
        $tags = array_merge($tags, $params["themes"]);
    }
    
    $new_id = add_cover($params["title"], $params["author"], 1, $params["shelf"]);

    foreach ($tags as $tag) {
        add_tag_to_cover($tag, $new_id);
    }
    $imageFileType = pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION);
    $uuid = add_cover_image($new_id, $imageFileType);
    upload_file($uuid);

    return "Upload succesful! See the <a href='../cover.php?id=$new_id'>newly uploaded cover</a> or
        <a href='../admin.php'>upload more covers</a>";
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
