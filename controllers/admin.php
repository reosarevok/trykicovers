<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";

$shelves = get_all("SELECT * FROM shelf");

$tags = get_all("SELECT tag_id, tag, tag_type FROM tag JOIN tag_type USING (tag_type_id)");