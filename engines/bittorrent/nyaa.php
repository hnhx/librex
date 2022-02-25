<?php
    function get_nyaa_results($query)
    {
        require_once "config.php";
        require_once "misc/tools.php";

        $url = "https://nyaa.si/?q=$query";
        $response = request($url);
        $xpath = get_xpath($response);

        $results = array();

        foreach($xpath->query("//tbody/tr") as $result)
        {
            global $config_bittorent_trackers;

            $name = $xpath->evaluate(".//td[@colspan='2']//a[not(contains(@class, 'comments'))]/@title", $result)[0]->textContent;
            $centered = $xpath->evaluate(".//td[@class='text-center']", $result);
            $magnet = $xpath->evaluate(".//a[2]/@href", $centered[0])[0]->textContent;
            $magnet_without_tracker = explode("&tr=", $magnet)[0];
            $magnet = $magnet_without_tracker . $config_bittorent_trackers;
            $size =  $centered[1]->textContent;
            $seeders =  $centered[3]->textContent;
            $leechers =  $centered[4]->textContent;

            array_push($results, 
                array (
                    "name" => $name,
                    "seeders" => (int) $seeders,
                    "leechers" => (int) $leechers,
                    "magnet" => $magnet,
                    "size" => $size,
                    "source" => "nyaa.si"
                )
            );
        }

        return $results;
    }
?>