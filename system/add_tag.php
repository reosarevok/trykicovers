<?php
require_once "database.php";

try    {
    if (!empty($_POST)) {
        $new_id = add_tag($_POST['tag'], $_POST['tag_type']);
        header( "Location: ../tag.php?id=$new_id" );
    }
    else {
        echo '<h4>Please add some data</h4>';
    }
}
catch(Exception $e)
{
    echo '<h4>'.$e->getMessage().'</h4>';
}