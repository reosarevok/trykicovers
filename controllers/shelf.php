<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";
if (!empty($_GET["id"])){
    $id = $_GET["id"];
    $shelf = get_first("SELECT * FROM shelf WHERE shelf_id = $id");
    $covers = get_all("SELECT * FROM cover JOIN cover_image USING (cover_id) WHERE shelf_id = $id");
}