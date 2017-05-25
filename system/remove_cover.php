<?php
require_once "database.php";

try {
    if (!empty($_GET['id'])) {
        remove_cover($_GET['id']);
        header("Location: ../index.php");
    } else {
        echo '<h4>Please add some data</h4>';
    }
} catch (Exception $e) {
    echo '<h4>' . $e->getMessage() . '</h4>';
}