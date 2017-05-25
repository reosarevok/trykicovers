<?php
require_once "database.php";

if (!empty($_POST)) {
    $cover = $db->cover()->where("cover_id", $_POST['cover_id'])->fetch();
    $cover->amount = $_POST['amount'];
    $cover->save();
    echo $cover->amount;
}