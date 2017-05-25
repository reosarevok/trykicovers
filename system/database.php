<?php
require __DIR__ . '/../vendor/autoload.php';
//Connect to database
$pdo = new \PDO(
    'mysql:host=127.0.0.1;dbname=trykicovers;charset=utf8',
    'root',
    '');
$db = new \LessQL\Database($pdo);
$db->setPrimary('shelf', 'shelf_id');
$db->setPrimary('shelf_space', 'shelf_id');
$db->setPrimary('shelf_type', 'shelf_id');
$db->setPrimary('cover', 'cover_id');
$db->setPrimary('tag_type', 'tag_type_id');
$db->setPrimary('tag', 'tag_id');
$db->setPrimary('cover_tag', array('cover_id', 'tag_id'));
$db->setPrimary('cover_user', array('cover_id', 'user_id'));

function add_cover($title, $transliterated_title, $translation, $author, $transliterated_author, $comment, $amount, $shelf)
{
    global $db;
    $row = $db->createRow('cover', array(
            'title' => $title,
            'transliterated_title' => $transliterated_title,
            'translated_title' => $translation,
            'author' => $author,
            'transliterated_author' => $transliterated_author,
            'comment' => $comment,
            'amount' => $amount,
            'shelf_id' => $shelf
        )
    );
    $db->begin();
    $row->save();
    $new_id = $db->lastInsertId();
    $db->commit();
    return $new_id;
}

function remove_cover($cover_id)
{
    global $db;
    $cover = $db->cover()->where("cover_id", $cover_id);
    $uuid = $cover->fetch()->image_uuid;
    $cover_image = dirname(getcwd()) . "/static/images/$uuid.jpg";
    if (file_exists($cover_image)) {
        unlink($cover_image);
    }
    $thumbnail = dirname(getcwd()) . "/static/images/$uuid-thumb.jpg";
    if (file_exists($thumbnail)) {
        unlink($thumbnail);
    }

    $cover->cover_tagList()->delete();
    $cover->delete();
}

function add_tag($tag, $tag_type)
{
    global $db;
    $row = $db->createRow('tag', array('tag' => $tag, 'tag_type_id' => $tag_type));
    $db->begin();
    $row->save();
    $new_id = $db->lastInsertId();
    $db->commit();
    return $new_id;
}

function add_tag_to_cover($tag, $cover)
{
    global $db;
    $row = $db->createRow('cover_tag', array('cover_id' => $cover, 'tag_id' => $tag));
    $db->begin();
    $row->save();
    $db->commit();

}

function remove_tag_from_cover($tag, $cover)
{
    global $db;
    $db->cover_tag()->where(array('cover_id' => $cover, 'tag_id' => $tag))->delete();
}

function display_cover($cover)
{
    $source = 'static/images/' . $cover->image_uuid . '-thumb.jpg';
    echo "<a href='cover.php?id=$cover->cover_id' target='_blank'><img class='center-block cover-image' src='$source'/></a><br>";

}