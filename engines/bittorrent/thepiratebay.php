<?php

    function get_thepiratebay_results($query)
    {
        require "config.php";
        require "misc/tools.php";

        $query = urlencode($query);

        $results = array();

        $url = "https://apibay.org/q.php?q=$query";
        $response = request($url);
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

    function print_thepiratebay_results($results)
    {
        echo "<div class=\"text-result-container\">";

            foreach($results as $result)
            {
                $hash = $result["hash"];
                $name = $result["name"];
                $seeders = $result["seeders"];
                $leechers = $result["leechers"];
                $magnet = $result["magnet"];

                echo "<div class=\"text-result-wrapper\">";
                echo "<a href=\"$magnet\">";
                echo "$hash";
                echo "<h2>$name</h2>";
                echo "</a>";
                echo "<span>SE: $seeders - LE: $leechers</span>";
                echo "</div>";
            }

        echo "</div>";
    }
?>