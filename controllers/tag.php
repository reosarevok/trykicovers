<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";
if (!empty($_GET["id"])){
    $id = $_GET["id"];
    $tag = get_first("SELECT * FROM tag JOIN tag_type USING (tag_type_id)
      WHERE tag_id = $id");
    $covers = get_all("SELECT * FROM cover JOIN cover_image USING (cover_id) JOIN cover_tag USING (cover_id)
      WHERE tag_id = $id");
}