<?php
require_once "database.php";
require_once "upload_file.php";

if (!isset($_FILES['cover_image']) || !(is_uploaded_file($_FILES['cover_image']['tmp_name']))) {
    echo '<p>Please select a file</p>';
} else if (@getimagesize($_FILES['cover_image']['tmp_name']) == false) {
    echo '<p>That file is not an image!</p>';
} else {
    try {
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            $uuid = $_POST['uuid'];
            upload_file($uuid);
            header("Location: ../cover.php?id=$id");
        } else {
            echo '<h4>No ID submitted</h4>';
        }
    } catch (Exception $e) {
        echo '<h4>' . $e->getMessage() . '</h4>';
    }
}