<?php
    require "config.php";

    if (!isset($_REQUEST["q"]))
    {
        echo "API usage: <a href=\"https://github.com/hnhx/librex/#api\">https://github.com/hnhx/librex/</a>";
        die();
    }

    $query = $_REQUEST["q"];
    $query_encoded = urlencode($query);
    $page = isset($_REQUEST["p"]) ? (int) $_REQUEST["p"] : 0;
    $type = isset($_REQUEST["type"]) ? (int) $_REQUEST["type"] : 0;

    $results = array();

    switch ($type)
    {
        case 0:
            require "engines/google/text.php";
            $results = get_text_results($query, $page);
            break;
        case 1:
            require "engines/google/image.php";
            $results = get_image_results($query_encoded);
            break;
        case 2:
            require "engines/google/video.php";
            $results = get_video_results($query_encoded, $page);
            break;
        case 3:
            if ($config_disable_bittorent_search)
                $results = array("error" => "disabled");
            else
            {
                require "engines/bittorrent/merge.php";
                $results = get_merged_torrent_results($query_encoded);
            }       
            break;
        default:
            require "engines/google/text.php";
            $results = get_text_results($query_encoded, $page);
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($results, JSON_PRETTY_PRINT);
?>