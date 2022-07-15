<?php
    require "../../misc/tools.php";
    $config = require "../../config.php";

    $url = $_REQUEST["url"];

    $response = request($url);
    $xpath = get_xpath($response);

    $magnet = $xpath->query("//main/div/div/div/div/div/ul/li/a/@href")[0]->textContent;
    $magnet_without_tracker = explode("&tr=", $magnet)[0];
    $magnet = $magnet_without_tracker . $config->bittorent_trackers;

    header("Location: $magnet")
?>