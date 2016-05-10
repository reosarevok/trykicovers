<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";

$tags = Array();

$tag_types = get_all("SELECT * FROM tag_type");

foreach ($tag_types as $tag_type) {
    $name = $tag_type['tag_type'];
    $id = $tag_type['tag_type_id'];
    $tags[$name] = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = $id");
}