<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";

$tags = array();

$tag_types = $db2->tag_type();


foreach ($tag_types as $tag_type) {
    $name = $tag_type->tag_type;
    $tag_type_id = $tag_type->tag_type_id;
    $tags[$name] = $tag_types->tagList()->where("tag_type_id", $tag_type_id);
}