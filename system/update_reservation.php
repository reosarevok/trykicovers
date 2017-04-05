<?php
require_once "database.php";

if (!empty($_POST)) {
    $reservation = $db2->cover_user()->where(array("cover_id" => $_POST['cover_id'], "user_id" => $_POST['user_id']))->fetch();
    $reservation->amount = $_POST['amount'];
    $reservation->save();
    echo $reservation->amount;
}