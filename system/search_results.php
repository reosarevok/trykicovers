<?php
require_once "database.php";
if (!empty($_POST)) {

    $joins = '';

    if (!empty($_POST['title'])) {
        $title = $_POST['title'];
        $parameters[] = "(title LIKE '%$title%' OR transliterated_title LIKE '%$title%' OR translated_title LIKE '%$title%')";
    }

    if (!empty($_POST['author'])) {
        $author = $_POST['author'];
        $parameters[] = "(author LIKE '%$author%' OR transliterated_author LIKE '%$author%')";
    }

    if (!empty($_POST['tag'])) {
        $tags = $_POST['tag'];
        $tag_query = implode(",", $tags);
        $tags_number = count($tags);
        $joins = 'JOIN cover_tag USING (cover_id)';
        $parameters[] = "tag_id IN ($tag_query) GROUP BY cover_id HAVING COUNT(DISTINCT tag_id) = $tags_number";
    }

    if (!empty($_POST['shelf'])) {
        $shelf = implode(",", $_POST['shelf']);
        $parameters[] = "shelf_id IN ($shelf)";
    }

    if (!empty($parameters)) {
        $parameters = implode(" AND ", $parameters);
        $sth = $db->prepare("SELECT * FROM cover $joins WHERE $parameters");
        $sth->execute();
        $results = $sth->fetchAll();
        //TODO: move this to use lessql somehow
        if (empty($results)) {
            echo "We didn't find anything like that. Sorry!";
        }
        else {
            foreach ($results as $result) {
                $id = $result['cover_id'];
                $cover = $db->cover()->where("cover_id", $id)->fetch();
                if ((!empty($_POST['show_all'])) || $result['amount'] > 0) {
                    display_cover($cover);
                }
            }
        }
    }
    else {
        echo "You need to search for *something*, duh!";
    }
}