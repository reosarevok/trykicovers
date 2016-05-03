<?php
require $_SERVER['DOCUMENT_ROOT']."/trykicovers/system/database.php";

    $covers = get_all("SELECT *
                   FROM cover
                   JOIN cover_image USING (cover_id)");
