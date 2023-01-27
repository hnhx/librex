<?php
    $config = require "config.php";
    require "misc/tools.php";

    if (!isset($_REQUEST["q"]))
    {
        echo "<p>Example API request: <a href=\"./api.php?q=gentoo&p=2&t=0\">./api.php?q=gentoo&p=2&t=0</a></p>
        <br/>
        <p>\"q\" is the keyword</p>
        <p>\"p\" is the result page (the first page is 0)</p>
        <p>\"t\" is the search type (0=text, 1=image, 2=video, 3=torrent, 4=tor)</p>
        <br/>
        <p>The results are going to be in JSON format.</p>
        <p>The API supports both POST and GET requests.</p>";

        die();
    }

    $query = $_REQUEST["q"];
    $query_encoded = urlencode($query);
    $page = isset($_REQUEST["p"]) ? (int) $_REQUEST["p"] : 0;
    $type = isset($_REQUEST["t"]) ? (int) $_REQUEST["t"] : 0;

    $results = array();

    switch ($type)
    {
        case 0:
            require "engines/google/text.php";
            $results = get_text_results($query, $page);
            break;
        case 1:
            require "engines/qwant/image.php";
            $results = get_image_results($query_encoded, $page);
            break;
        case 2:
            require "engines/invidious/video.php";
            $results = get_video_results($query_encoded);
            break;
        case 3:
            if ($config->disable_bittorent_search)
                $results = array("error" => "disabled");
            else
            {
                require "engines/bittorrent/merge.php";
                $results = get_merged_torrent_results($query_encoded);
            }
            break;
        case 4:
            if ($config->disable_hidden_service_search)
                $results = array("error" => "disabled");
            else
            {
                require "engines/ahmia/hidden_service.php";
                $results = get_hidden_service_results($query_encoded);
            }
            break;
        default:
            require "engines/google/text.php";
            $results = get_text_results($query_encoded, $page);
            break;
    }

    header("Content-Type: application/json");
    echo json_encode($results);
?>
