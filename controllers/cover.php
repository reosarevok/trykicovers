<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";
if (!empty($_GET["id"])){
    $id = $_GET["id"];
    $cover = get_first("SELECT * FROM cover JOIN cover_image USING (cover_id) JOIN shelf USING (shelf_id)
      WHERE cover_id = $id");
    $tag_types = get_all("SELECT * FROM tag_type");

    foreach ($tag_types as $tag_type) {
        $name = $tag_type['tag_type'];
        $tag_type_id = $tag_type['tag_type_id'];
        $tags[$name] = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) JOIN cover_tag USING (tag_id)
      WHERE cover_id = $id AND tag_type_id = $tag_type_id");
    }
}