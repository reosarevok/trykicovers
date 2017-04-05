<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";
if (!empty($_GET["id"])){
    $id = $_GET["id"];
    $cover = $db2->cover()->where("cover_id", $id)->fetch();
    $reservations = $db2->cover_user()->where("cover_id", $id);
    $user_reservation = $db2->cover_user()->where(array("cover_id" => $id, "user_id" => $_SESSION['user_id']))->fetch();
    $tag_types = $db2->tag_type();
    $tags = array();

    foreach ($tag_types as $tag_type) {
        $name = $tag_type->tag_type;
        $tag_type_id = $tag_type->tag_type_id;
        $tags[$name] = $cover->cover_tagList()->tag()->where("tag_type_id", $tag_type_id);
    }

}