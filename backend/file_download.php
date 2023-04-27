<?php
error_reporting (E_ALL ^ E_NOTICE);
include('../session.php');

$url = M3U;
echo $url;

$destination_folder = $_SERVER['DOCUMENT_ROOT'].'/IPTV/Listas/';


    $newfname = $destination_folder .'myfileeee.m3u'; //set your file ext

    $file = fopen ($url, "rb");

    if ($file) {
      $newf = fopen ($newfname, "a"); // to overwrite existing file

      if ($newf)
      while(!feof($file)) {
        fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );

      }
    }

    if ($file) {
      fclose($file);
    }

    if ($newf) {
      fclose($newf);
    }
?>
