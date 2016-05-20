<?php
require_once "database.php";

if(!isset($_FILES['cover_image']) || !(is_uploaded_file($_FILES['cover_image']['tmp_name'])))
{
    echo '<p>Please select a file</p>';
}
else if (@getimagesize($_FILES['cover_image']['tmp_name']) == false) {
    echo '<p>That file is not an image!</p>';
}
else
{
    try    {
        if (!empty($_POST)) {
           echo insert_new_cover($_POST);
        }
        else {
            echo '<h4>Please add some data</h4>';
        }
    }
    catch(Exception $e)
    {
        echo '<h4>'.$e->getMessage().'</h4>';
    }
}

function insert_new_cover($params)
{
    $tags = Array();

    if (empty($params["products"])) {
        return "You must select at least one product!";
    } else {
        $tags = array_merge($tags, $params["products"]);
    }

    if (empty($params["languages"])) {
        return "You must select at least one language!";
    } else {
        $tags = array_merge($tags, $params["languages"]);
    }

    if (empty($params["materials"])) {
        return "You must select at least one material!";
    } else {
        $tags = array_merge($tags, $params["materials"]);
    }

    if (empty($params["colors"])) {
        return "You must select at least one color!";
    } else {
        $tags = array_merge($tags, $params["colors"]);
    }

    if (empty($params["thicknesses"])) {
        return "You must select the thickness!";
    } else {
        $tags = array_merge($tags, $params["thicknesses"]);
    }

    if (empty($params["heights"])) {
        return "You must select the height!";
    } else {
        $tags = array_merge($tags, $params["heights"]);
    }

    if (empty($params["widths"])) {
        return "You must select the width!";
    } else {
        $tags = array_merge($tags, $params["widths"]);
    }

    if (!empty($params["themes"])) {
        $tags = array_merge($tags, $params["themes"]);
    }
    
    $new_id = add_cover($params["title"], $params["title_transliteration"], $params["translation"],
        $params["author"], $params["author_transliteration"], $params["comment"], 1, $params["shelf"]);

    foreach ($tags as $tag) {
        add_tag_to_cover($tag, $new_id);
    }

    $uuid = add_cover_image($new_id);
    upload_file($uuid);

    return "Upload succesful! See the <a href='../cover.php?id=$new_id'>newly uploaded cover</a> or
        <a href='../add_cover.php'>upload more covers</a>";
}

function upload_file($uuid) {
    if(is_uploaded_file($_FILES['cover_image']['tmp_name']) && getimagesize($_FILES['cover_image']['tmp_name']) != false)
    {
        $image = $_FILES['cover_image']['tmp_name'];
        $imageFileType = pathinfo($_FILES['cover_image']['name'],PATHINFO_EXTENSION);
        $image_dir = dirname(getcwd()).'/static/images';

        if (preg_match('/jpg|jpeg/i',$imageFileType)) {
            $imageTmp=imagecreatefromjpeg($image);
        } else if (preg_match('/png/i',$imageFileType)) {
            $imageTmp=imagecreatefrompng($image);
        } else if (preg_match('/gif/i',$imageFileType)) {
            $imageTmp=imagecreatefromgif($image);
        } else if (preg_match('/bmp/i',$imageFileType)) {
            $imageTmp=imagecreatefrombmp($image);
        } else {
            return 0;
        }

        /* Create jpg */
        list($width_orig,$height_orig) = getimagesize($image);
        $ratio = $width_orig / $height_orig;

        $width  = 1600;
        $height = 1600;

        if (($width / $height) > $ratio) {
            $width = $height * $ratio;
        } else {
            $height = $width / $ratio;
        }

        $new_image = imagecreatetruecolor($width,$height);
        imagecopyresampled($new_image,$imageTmp,0,0,0,0,$width,$height,$width_orig,$height_orig);
        $dest_file = "$image_dir/$uuid.jpg";
        imagejpeg($new_image,$dest_file);

        /* Create thumbnail */
        $width_thumb = 500;
        $height_thumb = 500;

        if (($width_thumb / $height_thumb) > $ratio) {
            $width_thumb = $height_thumb * $ratio;
        } else {
            $height_thumb = $width_thumb / $ratio;
        }

        $new_thumbnail = imagecreatetruecolor($width_thumb,$height_thumb);
        imagecopyresampled($new_thumbnail,$imageTmp,0,0,0,0,$width_thumb,$height_thumb,$width_orig,$height_orig);
        $dest_thumbnail = "$image_dir/$uuid-thumb.jpg";
        imagejpeg($new_thumbnail,$dest_thumbnail);
    }
};
