<?php
//Connect to database
$db = mysqli_connect('localhost', 'root', '', 'trykicovers') or die(mysqli_error($db));
mysqli_query($db, "SET NAMES 'utf8'");

function get_all($sql)
{
    global $db;
    $result = array();
    $query_result = mysqli_query($db, $sql) or exit(mysqli_error($db));
    while ($row = mysqli_fetch_assoc($query_result)) {
        $result[] = $row;
    }
    return $result;
}
function get_first($sql)
{
    global $db;
    $query_result = mysqli_query($db, $sql) or exit(mysqli_error($db));
    $result = mysqli_fetch_assoc($query_result);
    return empty($result) ? array() : $result;
}
function add_cover($title, $author, $amount, $shelf)
{
    global $db;
    $title = mysqli_real_escape_string($db, $title);
    $author = mysqli_real_escape_string($db, $author);
    mysqli_query($db, "INSERT INTO cover (title, author, amount, shelf_id) VALUES ('$title', '$author', $amount, $shelf)") or exit(mysqli_error($db));
    return mysqli_insert_id($db);
}
function add_tag($tag)
{
    global $db;
    $tag = mysqli_real_escape_string($db, $tag);
    mysqli_query($db, "INSERT INTO tag (tag) VALUES ('$tag')") or exit(mysqli_error($db));
    return mysqli_insert_id($db);
}
function add_tag_to_cover($tag, $cover)
{
    global $db;
    $tag = mysqli_real_escape_string($db, $tag);
    $tag_id = get_first("SELECT tag_id FROM tag WHERE tag = '$tag'");
    if (empty($tag_id)) {
        $tag_id = add_tag($tag);
    }
    mysqli_query($db, "INSERT INTO cover_tag (cover_id, tag_id) VALUES ($cover, $tag_id)") or exit(mysqli_error($db));
    return mysqli_insert_id($db);
}
function add_cover_image($image, $cover) {
    if(is_uploaded_file($_FILES['cover_image']['tmp_name']) && getimagesize($_FILES['cover_image']['tmp_name']) != false)
    {

    }

}