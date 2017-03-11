<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";

$shelves = get_all("SELECT * FROM shelf");

$colors = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 1");
$languages = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 2");
$products = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 3");
$materials = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 4");
$themes = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 5");
$widths = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 6");
$heights = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 7");
$thicknesses = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 8");

if (!(empty($_GET['id']))) {
    $id = $_GET['id'];
    $cover = get_first("SELECT * FROM cover JOIN shelf USING (shelf_id)
      WHERE cover_id = $id");
    $tags_result = get_all("SELECT tag_id FROM tag JOIN cover_tag USING (tag_id)
      WHERE cover_id = $id");
    $tags = array();
    array_walk_recursive($tags_result, function($a) use (&$tags) { $tags[] = $a; });

    $used_colors = array();
    foreach ($colors as $color) {
        if (in_array($color['tag_id'], $tags)) {
            $used_colors[] = $color;
        }
    }

    $used_themes = array();
    foreach ($themes as $theme) {
        if (in_array($theme['tag_id'], $tags)) {
            $used_themes[] = $theme;
        }
    }
}