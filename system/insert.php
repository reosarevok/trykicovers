<?php
require_once "database.php";
print_r($_POST);

if(!isset($_FILES['userfile']))
{
    echo '<p>Please select a file</p>';
}
else
{
    try    {
        upload();
        /*** give praise and thanks to the php gods ***/
        echo '<p>Thank you for submitting</p>';

        IF (!empty($_POST)) {
            $new_id = add_cover($_POST["title"], $_POST["author"], 1, $_POST["shelf"]);
            foreach ($_POST["tags"] as $tag) {
                add_tag_to_cover($tag, $new_id);
            }
            add_cover_image($_POST["image"], $new_id);
            $new_book = get_first("SELECT * FROM book WHERE book_id = $new_id");
            print_r($new_book);
        }
    }
    catch(Exception $e)
    {
        echo '<h4>'.$e->getMessage().'</h4>';
    }
}

