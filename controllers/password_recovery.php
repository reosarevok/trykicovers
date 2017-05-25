<?php
require $_SERVER['DOCUMENT_ROOT'] . "/trykicovers/system/database.php";

$user = $db->users()->where('username', $_POST['username'])->fetch();

