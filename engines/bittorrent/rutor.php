<?php
    $rutor_url = "http://rutor.info/search/$query";

    function get_rutor_results($response)
    {
        global $config;
        $xpath = get_xpath($response);
        $results = array();


        foreach($xpath->query("//table/tr[@class='gai' or @class='tum']") as $result)
        {

            $name = $xpath->evaluate(".//td/a", $result)[2]->textContent;
            $magnet =  $xpath->evaluate(".//td/a/@href", $result)[1]->textContent;
            $magnet_without_tracker = explode("&tr=", $magnet)[0];
            $magnet = $magnet_without_tracker . $config->bittorent_trackers;
            $size = $xpath->evaluate(".//td", $result)[3]->textContent;
            $seeders = $xpath->evaluate(".//span", $result)[0]->textContent;
            $leechers = $xpath->evaluate(".//span", $result)[1]->textContent;

            array_push($results, 
                array (
                    "name" => htmlspecialchars($name),
                    "seeders" => (int) remove_special($seeders),
                    "leechers" => (int) remove_special($leechers),
                    "magnet" => htmlspecialchars($magnet),
                    "size" => htmlspecialchars($size),
                    "source" => "rutor.info"
                )
            );
        }

        return $results;
    }
?>
