<?php

    function text_results($xpath) 
    {
        require_once "tools.php";

        $results = array();

        foreach($xpath->query("//div[@id='search']//div[contains(@class, 'g')]") as $result)
        {
            $url = $xpath->evaluate(".//div[@class='yuRUbf']//a/@href", $result)[0];

            if ($url == null)
                continue;

            if (!empty($results)) // filter duplicate results
                if (end($results)["url"] == $url->textContent)
                    continue;

            $title = $xpath->evaluate(".//h3", $result)[0];
            $description = $xpath->evaluate(".//div[contains(@class, 'VwiC3b')]", $result)[0];

            array_push($results, 
                array (
                    "title" => $title->textContent,
                    "url" =>  $url->textContent,
                    "base_url" => get_base_url($url->textContent),
                    "description" => $description == null ? "No description was provided for this site." : $description->textContent
                )
            );
        }

        return $results;
    }
?>