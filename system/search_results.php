<?php
require_once "database.php";
if (!empty($_POST)) {

    $joins = '';

    if (!empty($_POST['title'])) {
        $title = $_POST['title'];
        $parameters[] = "title LIKE '%$title%'";
    }

    if (!empty($_POST['author'])) {
        $author = $_POST['author'];
        $parameters[] = "author LIKE '%$author%'";
    }

    if (!empty($_POST['tag'])) {
        $tags = $_POST['tag'];
        $tag_query = implode(",", $tags);
        $tags_number = count($tags);
        $joins = 'JOIN cover_tag USING (cover_id)';
        $parameters[] = "tag_id IN ($tag_query) GROUP BY cover_id HAVING COUNT(DISTINCT tag_id) = $tags_number";
    }

    if (!empty($parameters)) {
        $parameters = implode(" AND ", $parameters);
        $results = get_all("SELECT * FROM cover $joins WHERE $parameters");
        if (empty($results)) {
            echo "We didn't find anything like that. Sorry!";
        }
        else {
            foreach ($results as $result) {
                $id = $result['cover_id'];
                display_cover($id);
            }
        }
    }
    else {
        echo "You need to search for *something*, duh!";
    }
}