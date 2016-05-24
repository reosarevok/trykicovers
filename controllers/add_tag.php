<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";

$tag_types = get_all("SELECT * FROM tag_type");