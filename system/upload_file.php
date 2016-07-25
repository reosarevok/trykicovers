<?

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