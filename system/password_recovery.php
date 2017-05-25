<?php
require_once "database.php";

if ($_POST['password'] != $_POST['passwordcheck']) {
    echo "Passwords didn't match!";
    }
$user = $db->users()->where('username', $_POST['username'])->fetch();
if ($user->answer != $_POST['answer']) {
    echo "Wrong answer!";
}
else {
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user->password = $hash;
    $user->save();
    header( "Location: ../login.php" );
}
