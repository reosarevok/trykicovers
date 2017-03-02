<?php
require_once "database.php";

if ($_POST['password'] != $_POST['passwordcheck']) {
    echo "Passwords didn't match!";
    }
else {
    $username = mysqli_real_escape_string($db, $_POST['username']);

    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($db, "INSERT INTO users (username, password) VALUES ('$username', '$hash')") or exit(mysqli_error($db));
    $id = mysqli_insert_id($db);
}
