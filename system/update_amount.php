<?php
require_once "database.php";

if (!empty($_POST)) {
    echo update_amount($_POST['cover_id'], $_POST['amount']);
}