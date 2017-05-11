<?php
require_once "database.php";

session_start();
$user = $db2->users()->where('username', $_POST['username'])->fetch();
if (password_verify($_POST['password'], $user->password)) {
    $_SESSION['username'] = $user->username;
    $_SESSION['user_id'] = $user->id;
    header( "Location: ../index.php" );
} else {
    echo "That was WRONG!";
}