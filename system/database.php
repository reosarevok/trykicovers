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
function add_cover($title, $transliterated_title, $translation, $author, $transliterated_author, $comment, $amount, $shelf)
{
    global $db;
    $title = mysqli_real_escape_string($db, $title);
    $transliterated_title = mysqli_real_escape_string($db, $transliterated_title);
    $translation = mysqli_real_escape_string($db, $translation);
    $author = mysqli_real_escape_string($db, $author);
    $transliterated_author = mysqli_real_escape_string($db, $transliterated_author);
    $comment = mysqli_real_escape_string($db, $comment);
    mysqli_query($db, "INSERT INTO cover (title, transliterated_title, translated_title, author,
transliterated_author, comment, amount, shelf_id) VALUES ('$title', '$transliterated_title', '$translation', '$author',
'$transliterated_author', '$comment', $amount, $shelf)") or exit(mysqli_error($db));
    return mysqli_insert_id($db);
}
function add_tag($tag, $tag_type)
{
    global $db;
    $tag = mysqli_real_escape_string($db, $tag);
    mysqli_query($db, "INSERT INTO tag (tag, tag_type_id) VALUES ('$tag', $tag_type)") or exit(mysqli_error($db));
    return mysqli_insert_id($db);
}
function add_tag_to_cover($tag, $cover)
{
    global $db;
    mysqli_query($db, "INSERT INTO cover_tag (cover_id, tag_id) VALUES ($cover, $tag)") or exit(mysqli_error($db));
    return mysqli_insert_id($db);
}
function add_cover_image($cover) {
    global $db;
    mysqli_query($db, "INSERT INTO cover_image (cover_id, image_uuid) VALUES ($cover, uuid())") or exit(mysqli_error($db));
    $id = mysqli_insert_id($db);
    $uuid = get_first("SELECT image_uuid FROM cover_image WHERE image_id = $id");
    return $uuid['image_uuid'];
}
function display_cover($cover_id) {

    $cover = get_first("SELECT * FROM cover JOIN cover_image USING (cover_id) JOIN shelf USING (shelf_id)
      WHERE cover_id = $cover_id");
    $source = 'static/images/' . $cover['image_uuid'] . '-thumb.jpg';
    if (!empty($cover)) {
        echo "<a href='cover.php?id=$cover_id' target='_blank'><img class='center-block cover-image' src='$source'/></a><br>";
    }
    else {
        echo "<a href='cover.php?id=$cover_id'>Image not found</a><br>";
    }

}
function update_amount($cover_id, $amount) {
    global $db;
    mysqli_query($db, "UPDATE cover SET amount = $amount WHERE cover_id = $cover_id") or exit(mysqli_error($db));
    $amount = get_first("SELECT amount FROM cover WHERE cover_id = $cover_id");
    return $amount['amount'];
}