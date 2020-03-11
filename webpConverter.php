<?php

/*
Copyright 2020 by Dawid Irzyk
Generate JPG or PNG to WEBP V8

GNU General Public License v3.0
Version 1.3

irzykdawid@gmail.com
*/

$url = strip_tags(htmlspecialchars($_GET['url']));

function load_jpeg($image)
{
    $im = imagecreatefromjpeg($image);
    return $im;
}

function load_png($image)
{
    $im = imagecreatefrompng($image);
    imagepalettetotruecolor($im);
    imagealphablending($im, true);
    imagesavealpha($im, true);
    return $im;
}

if(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {
    
    if (strpos($url, "jpg") !== false) {
        $img = load_jpeg($url);
        header('Content-Type: image/jpeg');
        imagejpeg($img);
        imagedestroy($img);
    }
    
    else if (strpos($url, "png") !== false) {
        $img = load_png($url);
        header('Content-Type: image/png');
        imagepng($img);
        imagedestroy($img);
    }
}

else {

    if (strpos($url, "jpg") !== false) {
        $img = load_jpeg($url);
        header('Content-Type: image/webp');
        imagewebp($img);
        imagedestroy($img);
    }
    
    else if (strpos($url, "png") !== false) {
        $img = load_png($url);
        header('Content-Type: image/webp');
        imagewebp($img);
        imagedestroy($img);
    }

}

?>