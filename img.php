<?php

#la qualité de l'image redimensionnée (0 = le plus mauvais, 100 = le meilleur)
define('IMAGE_REDUCED_QUALITY', 80);

$small_width = 90;
$small_height = 90;
$med_width = 640;
$med_height = 480;

if (!isset($_GET['size']) || $_GET['size'] == 'big' || $_GET['size'] == '') {
    $_GET['size'] = 0;
}
function resize($src, $dest, $new_width, $new_height)
{
    if (!file_exists($src)) {
        die('No source to sample picture: ' . $src);
    }

    $image_big = ImageCreateFromJpeg($src);
    $height = imageSY($image_big);
    $width = imageSX($image_big);

    $ratio_hor = 1;
    $ratio_ver = 1;

    if ($height > $new_height) {
        $ratio_ver = $new_height / $height;
    }

    if ($width > $new_width) {
        $ratio_hor = $new_width / $width;
    }

    $ratio = min($ratio_hor, $ratio_ver);

    $new_height = round($height * $ratio);
    $new_width = round($width * $ratio);

    $image_redim = imagecreatetruecolor($new_width, $new_height); #l'apercu de l'image (plus petite)
    imagecopyresampled($image_redim, $image_big, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    imagejpeg($image_redim, $dest, IMAGE_REDUCED_QUALITY); #ecrit l'apercu sur le disque
}

//Constructage du nom de fichier src et dest
$path = 'img/';
$src = $path . $_GET['num'] . '.jpg';
if (!$_GET['size']) {
    $dest = $src;
} else {
    $dest = $path . ($_GET['size'] ? $_GET['size'] . '_' : '') . $_GET['num'] . '.jpg';
}

//Cherche le fichier
if (file_exists($dest)) {
    header('content-type: image/jpeg');
    readfile($dest);
} elseif ($src == $dest) {
    echo "The original file $dest does not exist";
} else {
    if ($_GET['size'] == 'med') {
        resize($src, $dest, $med_width, $med_height);
    } elseif ($_GET['size'] == 'small') {
        resize($src, $dest, $small_width, $small_height);
    }

    header('content-type: image/jpeg');
    readfile($dest);
}
