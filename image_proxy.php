<?php

    $config = require "config.php";
    require "misc/tools.php";

    $url = $_REQUEST["url"];

    $split_url = explode("/", $url);
    $base_url = $split_url[2];
    
    $base_url_main_split = explode(".", strrev($base_url));
    $base_url_main = strrev($base_url_main_split[1]) . "." . strrev($base_url_main_split[0]);

    if ($base_url_main == "qwant.com" || $base_url_main == "wikimedia.org")
    {
      $image = $url;
      $image_src = request($image);

      header("Content-Type: image/jpeg");
      echo $image_src;
    }
?>
