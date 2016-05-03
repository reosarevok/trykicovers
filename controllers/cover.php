<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";
if (!empty($_GET["id"])){
    $id = $_GET["id"];
    $cover = get_first("SELECT * FROM cover JOIN cover_image USING (cover_id) JOIN shelf USING (shelf_id)
      WHERE cover_id = $id");
    $tags = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) JOIN cover_tag USING (tag_id)
      WHERE cover_id = $id");
}