<?php

    function get_bittorrent_results($query)
    {
        require "config.php";

        $query = urlencode($query);

        $results = array();

        $url = "https://apibay.org/q.php?q=$query";

        $ch = curl_init($url);
        curl_setopt_array($ch, $config_curl_settings);
        $response = curl_exec($ch);
        
        
        $json_response = json_decode($response, true);

        foreach ($json_response as $response)
        {

            $hash = $response["info_hash"];
            $name = $response["name"];
            $seeders = $response["seeders"];
            $leechers = $response["leechers"];

            $magnet = "magnet:?xt=urn:btih:$hash&dn=$name";

            array_push($results, 
                array (
                    "hash" => $hash,
                    "name" => $name,
                    "seeders" => $seeders,
                    "leechers" => $leechers,
                    "magnet" => $magnet
                )
            );
        }

        return $results;
       
    }
?>