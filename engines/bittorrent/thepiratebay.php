<?php

$thepiratebay_url = "https://apibay.org/q.php?q=$query";

function get_thepiratebay_results($response)
{
    global $config;
    $results = array();
    $json_response = json_decode($response, true);

    foreach ($json_response as $response) {

        $size = human_filesize($response["size"]);
        $hash = $response["info_hash"];
        $name = $response["name"];
        $seeders = (int)$response["seeders"];
        $leechers = (int)$response["leechers"];

        $magnet = "magnet:?xt=urn:btih:$hash&dn=$name" . $config->bittorent_trackers;

        if ($name == "No results returned")
            break;

        $results[] = array(
            "size" => htmlspecialchars($size),
            "name" => htmlspecialchars($name),
            "seeders" => htmlspecialchars($seeders),
            "leechers" => htmlspecialchars($leechers),
            "magnet" => htmlspecialchars($magnet),
            "source" => "thepiratebay.org"
        );
    }

    return $results;

}
