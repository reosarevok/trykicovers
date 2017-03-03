<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";

if (!(empty($_GET['id']))) {
    $id = $_GET['id'];
    $cover = $db2->cover()->where("cover_id", $id)->fetch();
}