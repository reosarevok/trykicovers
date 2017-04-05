<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";

$shelves = $db2->shelf();

$all_tags = $db2->tag_type()->tagList();
$colors = $all_tags->where("tag_type_id", 1);
$languages = $all_tags->where("tag_type_id", 2);
$products = $all_tags->where("tag_type_id", 3);
$materials = $all_tags->where("tag_type_id", 4);
$themes = $all_tags->where("tag_type_id", 5);
$widths = $all_tags->where("tag_type_id", 6);
$heights = $all_tags->where("tag_type_id", 7);
$thicknesses = $all_tags->where("tag_type_id", 8);

if (!(empty($_GET['id']))) {
    $id = $_GET['id'];
    $cover = $db2->cover()->where("cover_id", $id);
    $used_tags = $cover->cover_tagList()->tag();
    $cover = $cover->fetch();
    $used_colors = $used_tags->where("tag_type_id", 1);
    $used_themes = $used_tags->where("tag_type_id", 5);
}