<?php
    $_1337x_url = "https://1337x.to/search/$query/1/";

    function get_1337x_results($response)
    {
        global $config;
        $xpath = get_xpath($response);
        $results = array();

        foreach($xpath->query("//table/tbody/tr") as $result)
        {

            $name = $xpath->evaluate(".//td[@class='coll-1 name']/a", $result)[1]->textContent;
            $magnet = "/engines/bittorrent/get_magnet_1337x.php?url=https://1337x.to" . $xpath->evaluate(".//td[@class='coll-1 name']/a/@href", $result)[1]->textContent;
            $size_unformatted = explode(" ", $xpath->evaluate(".//td[contains(@class, 'coll-4 size')]", $result)[0]->textContent);
            $size = $size_unformatted[0] . " " . preg_replace("/[0-9]+/", "", $size_unformatted[1]);
            $seeders = $xpath->evaluate(".//td[@class='coll-2 seeds']", $result)[0]->textContent;
            $leechers = $xpath->evaluate(".//td[@class='coll-3 leeches']", $result)[0]->textContent;

            array_push($results, 
                array (
                    "name" => htmlspecialchars($name),
                    "seeders" => (int) $seeders,
                    "leechers" => (int) $leechers,
                    "magnet" => htmlspecialchars($magnet),
                    "size" => htmlspecialchars($size),
                    "source" => "1337x.to"
                )
            );
        }

        return $results;
    }
?>
