<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";
if (!empty($_GET["id"])){
    $id = $_GET["id"];
    $cover = $db2->cover()->where("cover_id", $id)->fetch();
    $tag_types = $db2->tag_type();
    $tags = array();

    foreach ($tag_types as $tag_type) {
        $name = $tag_type->tag_type;
        $tag_type_id = $tag_type->tag_type_id;
        $tags[$name] = $cover->cover_tagList()->tag()->where("tag_type_id", $tag_type_id);
    }
}