<?php
require_once "database.php";

session_start();
$username = mysqli_real_escape_string($db, $_POST['username']);
$user = $db2->users()->where('username', $username)->fetch();
if (password_verify($_POST['password'], $user->password)) {
    $_SESSION['username'] = $username;
    header( "Location: ../index.php" );
} else {
    echo "That was WRONG!";
}