<?php

    function get_thepiratebay_results($query)
    {
        require_once "config.php";
        require_once "misc/tools.php";

        $query = urlencode($query);

        $results = array();

        $url = "https://apibay.org/q.php?q=$query";
        $response = request($url);
        $json_response = json_decode($response, true);

        foreach ($json_response as $response)
        {

            global $config_bittorent_trackers;

            $size = human_filesize($response["size"]);
            $hash = $response["info_hash"]; 
            $name = $response["name"];
            $seeders = (int) $response["seeders"];
            $leechers = (int) $response["leechers"];

            $magnet = "magnet:?xt=urn:btih:$hash&dn=$name$config_bittorent_trackers";

            array_push($results, 
                array (
                    "size" => $size,
                    "name" => $name,
                    "seeders" => $seeders,
                    "leechers" => $leechers,
                    "magnet" => $magnet,
                    "source" => "thepiratebay.org"
                )
            );
        }

        return $results;
       
    }
?>