<?php
    $nyaa_url = "https://nyaa.si/?q=$query";

    function get_nyaa_results($response)
    {
        global $config;
        $xpath = get_xpath($response);
        $results = array();

        foreach($xpath->query("//tbody/tr") as $result)
        {
            $name = $xpath->evaluate(".//td[@colspan='2']//a[not(contains(@class, 'comments'))]/@title", $result)[0]->textContent;
            $centered = $xpath->evaluate(".//td[@class='text-center']", $result);
            $magnet = $xpath->evaluate(".//a[2]/@href", $centered[0])[0]->textContent;
            $magnet_without_tracker = explode("&tr=", $magnet)[0];
            $magnet = $magnet_without_tracker . $config->bittorent_trackers;
            $size =  $centered[1]->textContent;
            $seeders =  $centered[3]->textContent;
            $leechers =  $centered[4]->textContent;

            array_push($results, 
                array (
                    "name" => htmlspecialchars($name),
                    "seeders" => (int) $seeders,
                    "leechers" => (int) $leechers,
                    "magnet" => htmlspecialchars($magnet),
                    "size" => htmlspecialchars($size),
                    "source" => "nyaa.si"
                )
            );
        }

        return $results;
    }
?>
