<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";

if (!empty($_GET["mainsearch"]))
{
    $mainsearch = $_GET["mainsearch"];
    $searchdrop = $_GET["searchdrop"];

//Connect to database
    $db = mysqli_connect('127.0.0.1', 'root', '', 'filmibaas') or die(mysqli_error($db));
    mysqli_query($db, "SET NAMES 'utf8'");

//otsing

    $books = get_all("SELECT *
                   FROM book
                   JOIN author USING (author_id)
                   WHERE book.title LIKE '%$mainsearch%'");


//test et array prindib
//print_r($film);
}