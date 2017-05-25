<?php
require_once "database.php";

try    {
    if (!empty($_POST)) {
        echo edit_existing_cover($_POST);
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
    global $db;
    $tags = Array();
    $cover_id = $params['cover_id'];
    $cover = $db->cover()->where("cover_id", $cover_id);
    $used_tags = $cover->cover_tagList()->tag();

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

    $cover = $cover->fetch();
    $cover->title = $params["title"];
    $cover->transliterated_title = $params["title_transliteration"];
    $cover->translated_title = $params["translation"];
    $cover->author = $params["author"];
    $cover->transliterated_author = $params["author_transliteration"];
    $cover->comment = $params["comment"];
    $cover->shelf_id = $params["shelf"];
    $cover->save();

    foreach ($used_tags as $tag) {
        if (!(in_array($tag->tag_id, $tags))) {
            remove_tag_from_cover($tag->tag_id, $cover_id);
        }
    }

    foreach ($tags as $tag) {
        if (empty($used_tags->where('tag_id', $tag)->fetch())) {
            add_tag_to_cover($tag, $cover_id);
        }
    }
    header( "Location: ../cover.php?id=$cover_id" );
}