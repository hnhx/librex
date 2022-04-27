<?php

    function get_merged_torrent_results($query)
    {
        global $config;

        require "engines/bittorrent/thepiratebay.php";
        require "engines/bittorrent/rutor.php";
        require "engines/bittorrent/nyaa.php";
        require "engines/bittorrent/yts.php";

        $query = urlencode($query);

        $torrent_urls = array(
            $thepiratebay_url,
            $rutor_url,
            $nyaa_url,
            $yts_url
        );
 
        $mh = curl_multi_init();
        $chs = $results = array();

        foreach ($torrent_urls as $url)
        {
            $ch = curl_init($url);
            curl_setopt_array($ch, $config->curl_settings);
            array_push($chs, $ch);
            curl_multi_add_handle($mh, $ch);    
        }

        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        for ($i=0; count($chs)>$i; $i++)
        {
            $response = curl_multi_getcontent($chs[$i]);

            switch ($i)
            {
                case 0:
                    $results = array_merge($results, get_thepiratebay_results($response));
                    break;
                case 1:
                    $results = array_merge($results, get_rutor_results($response));
                    break;
                case 2:
                    $results = array_merge($results, get_nyaa_results($response));
                    break;
                case 3:
                    $results = array_merge($results, get_yts_results($response));
                    break;
            }
        }
        
        $seeders = array_column($results, "seeders");
        array_multisort($seeders, SORT_DESC, $results);

        return $results; 
    }

    function print_merged_torrent_results($results)
    {
        echo "<div class=\"text-result-container\">";

        if (!empty($results)) 
        {
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
        }
        else
            echo "<p>There are no results. Please try different keywords!</p>";

        echo "</div>";
    }

?>