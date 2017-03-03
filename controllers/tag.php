<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";
if (!empty($_GET["id"])){
    $id = $_GET["id"];
    $tag = $db2->tag()->where("tag_id", $id);
    $covers = $tag->cover_tagList()->cover();
}