<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";

$colors = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 1");
$languages = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 2");
$products = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 3");
$materials = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 4");
$themes = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 5");
$widths = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 6");
$heights = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 7");
$thicknesses = get_all("SELECT * FROM tag JOIN tag_type USING (tag_type_id) WHERE tag_type_id = 8");