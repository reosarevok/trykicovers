<?php
require_once "database.php";

if ($_POST['password'] != $_POST['passwordcheck']) {
    echo "Passwords didn't match!";
} else {
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sth = $db->prepare("INSERT INTO users (username, password, question, answer) VALUES (?, ?, ?, ?)");
    $sth->bindParam(1, $_POST['username']);
    $sth->bindParam(2, $hash);
    $sth->bindParam(3, $_POST['question']);
    $sth->bindParam(4, $_POST['answer']);
    $sth->execute();
    header("Location: ../login.php");
}
