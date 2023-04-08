<?php
    $sukebei_url = "https://sukebei.nyaa.si/?q=$query";

    function get_sukebei_results($response)
    {
        global $config;
        $xpath = get_xpath($response);
        $results = array();

        foreach($xpath->query("//tbody/tr") as $result)
        {
            $name_node = $xpath->evaluate(".//td[@colspan='2']//a[not(contains(@class, 'comments'))]/@title", $result);
            if ($name_node->length > 0) {
                $name = $name_node[0]->textContent;
            } else {
                $name = "";
            }
            $centered = $xpath->evaluate(".//td[@class='text-center']", $result);
            $magnet_node = $xpath->evaluate(".//a[2]/@href", $centered[0]);
            if ($magnet_node->length > 0) {
                $magnet = $magnet_node[0]->textContent;
                $magnet_without_tracker = explode("&tr=", $magnet)[0];
                $magnet = $magnet_without_tracker . $config->bittorent_trackers;
            } else {
                $magnet = "";
            }
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
                    "source" => "sukebei.nyaa.si"
                )
            );
        }
        return $results;
    }
?>
