<?php
    require "engines/google.php";
    require "engines/bittorrent.php";

    if (!isset($_REQUEST["q"]))
    {
        echo "API usage: <a href=\"https://github.com/hnhx/librex/#api\">https://github.com/hnhx/librex/</a>";
        die();
    }

    $query = $_REQUEST["q"];
    $page = isset($_REQUEST["p"]) ? (int) $_REQUEST["p"] : 0;
    $type = isset($_REQUEST["type"]) ? (int) $_REQUEST["type"] : 0;

    $results = $type != 3 ? get_google_results($query, $page, $type) : get_bittorrent_results($query);

    header('Content-Type: application/json');
    echo json_encode($results, JSON_PRETTY_PRINT);
?>