<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";
if (!empty($_GET["id"])){
    $id = $_GET["id"];
    $shelf = $db2->shelf()->where("shelf_id", $id)->fetch();
    $covers = $shelf->coverList();
}