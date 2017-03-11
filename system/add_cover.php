<?php
require_once "database.php";
require_once "upload_file.php";

if(!isset($_FILES['cover_image']) || !(is_uploaded_file($_FILES['cover_image']['tmp_name'])))
{
    echo '<p>Please select a file</p>';
}
else if (@getimagesize($_FILES['cover_image']['tmp_name']) == false) {
    echo '<p>That file is not an image!</p>';
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
    global $db2;
    $tags = Array();

    if (empty($params["products"])) {
        return "You must select at least one product!";
    } else {
        $tags = array_merge($tags, $params["products"]);
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

    if (empty($params["thicknesses"])) {
        return "You must select the thickness!";
    } else {
        $tags = array_merge($tags, $params["thicknesses"]);
    }

    if (empty($params["heights"])) {
        return "You must select the height!";
    } else {
        $tags = array_merge($tags, $params["heights"]);
    }

    if (empty($params["widths"])) {
        return "You must select the width!";
    } else {
        $tags = array_merge($tags, $params["widths"]);
    }

    if (!empty($params["themes"])) {
        $tags = array_merge($tags, $params["themes"]);
    }

    $shelf = choose_shelf($params["products"]);

    $new_id = add_cover($params["title"], $params["title_transliteration"], $params["translation"],
        $params["author"], $params["author_transliteration"], $params["comment"], 1, $shelf);

    foreach ($tags as $tag) {
        add_tag_to_cover($tag, $new_id);
    }

    $uuid = $db2->cover()->where("cover_id", $new_id)->fetch()->image_uuid;

    upload_file($uuid);

    header( "Location: ../cover.php?id=$new_id" );

}


function choose_shelf ($products) {

    if (in_array(23, $products)) {
        $type = "Sherlock";
    }
    else if (in_array(21, $products)) {
        $type = "Classic";
    }
    else if (in_array(20, $products)) {
        $type = "College";
    }
    else if (in_array(22, $products)) {
        $type = "Artisan";
    }

    $shelf = get_first("SELECT * FROM shelf_space JOIN shelf_type USING (shelf_id) WHERE percentage_filled < 90 AND tag = '$type' ORDER BY percentage_filled DESC");

    if (empty($shelf)) {
        $shelf = get_first("SELECT * FROM shelf_space WHERE percentage_filled = 0");
    }

    if (empty($shelf)) {
        $shelf = get_first("SELECT * FROM shelf_space JOIN shelf_type USING (shelf_id) WHERE tag = '$type' ORDER BY percentage_filled ASC");
    }

    return $shelf["shelf_id"];
}