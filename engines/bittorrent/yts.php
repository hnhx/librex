<?php
    $yts_url = "https://yts.mx/api/v2/list_movies.json?query_term=$query";

    function get_yts_results($response)
    {
        global $config;
        $results = array();
        $json_response = json_decode($response, true);

        if ($json_response["status"] == "ok" && $json_response["data"]["movie_count"] != 0)
        {
            foreach ($json_response["data"]["movies"] as $movie)
            {
                    $name = $movie["title"];
                    $name_encoded = urlencode($name);

                    foreach ($movie["torrents"] as $torrent)
                    {

                        $hash = $torrent["hash"];
                        $seeders = $torrent["seeds"];
                        $leechers = $torrent["peers"];
                        $size = $torrent["size"];

                        $magnet = "magnet:?xt=urn:btih:$hash&dn=$name_encoded$config->bittorent_trackers";

                        array_push($results, 
                        array (
                            "size" => htmlspecialchars($size),
                            "name" => htmlspecialchars($name),
                            "seeders" => htmlspecialchars($seeders),
                            "leechers" => htmlspecialchars($leechers),
                            "magnet" => htmlspecialchars($magnet),
                            "source" => "yts.mx"
                        )
                    );
                    
                    }
            }
        }

        return $results;
       
    }
?>
