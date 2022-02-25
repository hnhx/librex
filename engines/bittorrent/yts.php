<?php

    function get_yts_results($query)
    {
        require_once "config.php";
        require_once "misc/tools.php";

        $query = urlencode($query);

        $results = array();

        $url = "https://yts.mx/api/v2/list_movies.json?query_term=$query";
        $response = request($url);
        $json_response = json_decode($response, true);

        if ($json_response["data"]["movie_count"] != 0)
        {
            foreach ($json_response["data"]["movies"] as $movie)
            {
                    $name = $movie["title"];
                    $name_encoded = urlencode($name);

                    foreach ($movie["torrents"] as $torrent)
                    {
                        global $config_bittorent_trackers;

                        $hash = $torrent["hash"];
                        $seeders = $torrent["seeds"];
                        $leechers = $torrent["peers"];
                        $size = $torrent["size"];

                        $magnet = "magnet:?xt=urn:btih:$hash&dn=$name_encoded$config_bittorent_trackers";

                        array_push($results, 
                        array (
                            "size" => $size,
                            "name" => $name,
                            "seeders" => $seeders,
                            "leechers" => $leechers,
                            "magnet" => $magnet,
                            "source" => "yts.mx"
                        )
                    );
                    
                    }
            }
        }

        return $results;
       
    }
?>