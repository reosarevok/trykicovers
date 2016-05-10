<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";

$shelves = get_all("SELECT * FROM shelf");