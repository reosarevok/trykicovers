<?php
require_once "database.php";

session_start();
$username = mysqli_real_escape_string($db, $_POST['username']);
$user = get_first("SELECT * FROM users WHERE username='$username'");
if (password_verify($_POST['password'], $user['password'])) {
    $_SESSION['username'] = $username;
    header( "Location: ../index.php" );
} else {
    echo "That was WRONG!";
}