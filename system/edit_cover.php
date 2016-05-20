<?php
require_once "database.php";

try    {
    if (!empty($_POST)) {
        edit_existing_cover($_POST);
    }
    else {
        echo '<h4>Please add some data</h4>';
    }
}
catch(Exception $e)
{
    echo '<h4>'.$e->getMessage().'</h4>';
}

function edit_existing_cover($params)
{
    $tags = Array();
    $cover_id = $params['cover_id'];
    $tags_result = get_all("SELECT tag_id FROM tag JOIN cover_tag USING (tag_id) WHERE cover_id = $cover_id");
    $existing_tags = array();
    array_walk_recursive($tags_result, function($a) use (&$existing_tags) { $existing_tags[] = $a; });

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

    edit_cover($cover_id, $params["title"], $params["title_transliteration"], $params["translation"],
        $params["author"], $params["author_transliteration"], $params["comment"], $params["shelf"]);

    foreach ($existing_tags as $tag) {
        if (!(in_array($tag, $tags))) {
            remove_tag_from_cover($tag, $cover_id);
        }
    }

    foreach ($tags as $tag) {
        if (!(in_array($tag, $existing_tags))) {
            add_tag_to_cover($tag, $cover_id);
        }
    }
    header( "Location: ../cover.php?id=$cover_id" );
}