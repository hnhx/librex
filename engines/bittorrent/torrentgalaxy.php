<?php
    $torrentgalaxy_url = "https://torrentgalaxy.to/torrents.php?search=$query#results";

    function get_torrentgalaxy_results($response)
    {
        global $config;
        $xpath = get_xpath($response);
        $results = array();

        foreach($xpath->query("//div[@class='tgxtablerow txlight']") as $result)
        {
            $name = $xpath->evaluate(".//div[contains(@class, 'clickable-row')]", $result)[0]->textContent;
            $magnet = $xpath->evaluate(".//div[@class='tgxtablecell collapsehide rounded txlight']/a/@href", $result)[1]->textContent;
            $magnet_without_tracker = explode("&tr=", $magnet)[0];
            $magnet = $magnet_without_tracker . $config->bittorent_trackers;
            $size = $xpath->evaluate(".//div[@class='tgxtablecell collapsehide rounded txlight']/span", $result)[0]->textContent;
            $seeders = $xpath->evaluate(".//div[@class='tgxtablecell collapsehide rounded txlight']/span/font", $result)[1]->textContent;
            $leechers = $xpath->evaluate(".//div[@class='tgxtablecell collapsehide rounded txlight']/span/font", $result)[2]->textContent;

            array_push($results, 
                array (
                    "name" => htmlspecialchars($name),
                    "seeders" => (int) $seeders,
                    "leechers" => (int) $leechers,
                    "magnet" => htmlspecialchars($magnet),
                    "size" => htmlspecialchars($size),
                    "source" => "torrentgalaxy.to"
                )
            );
        }

        return $results;
    }
?>
