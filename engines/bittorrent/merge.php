<?php

    function get_merged_torrent_results($query)
    {
        require "engines/bittorrent/thepiratebay.php";
        require "engines/bittorrent/nyaa.php";
        require "engines/bittorrent/yts.php";

        $results = array_merge(get_thepiratebay_results($query), 
                               get_nyaa_results($query),
                               get_yts_results($query));

        $seeders = array_column($results, "seeders");
        array_multisort($seeders, SORT_DESC, $results);
        
        return $results; 
    }

    function print_merged_torrent_results($results)
    {
        echo "<div class=\"text-result-container\">";

            foreach($results as $result)
            {
                $source = $result["source"];
                $name = $result["name"];
                $magnet = $result["magnet"];
                $seeders = $result["seeders"];
                $leechers = $result["leechers"];
                $size = $result["size"];

                echo "<div class=\"text-result-wrapper\">";
                echo "<a href=\"$magnet\">";
                echo "$source";
                echo "<h2>$name</h2>";
                echo "</a>";
                echo "<span>SE: <span style=\"color:#50fa7b\">$seeders</span> - ";
                echo "LE: <span style=\"color:#ff79c6\">$leechers</span> - ";
                echo "$size</span>";
                echo "</div>";
            }

        echo "</div>";
    }

?>