<?php

    $config = require "config.php";
    require "misc/tools.php";

    $image = $_REQUEST["url"];

    $image_src = request($image);

    header("Content-Type: image/jpeg");
    echo $image_src;
?>
