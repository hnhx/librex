<?php

    function text_results($xpath) 
    {
        require_once "tools.php";
        require "config.php";

        $results = array();

        foreach($xpath->query("//div[@id='search']//div[contains(@class, 'g')]") as $result)
        {
            $url = $xpath->evaluate(".//div[@class='yuRUbf']//a/@href", $result)[0];

            if ($url == null)
                continue;

            if (!empty($results)) // filter duplicate results
                if (end($results)["url"] == $url->textContent)
                    continue;

            $url = $url->textContent;
            if ($config_replace_yt_with_invidious != null)
            {
                $url = str_replace("youtube.com", $config_replace_yt_with_invidious, $url);
            }
            
            $title = $xpath->evaluate(".//h3", $result)[0];
            $description = $xpath->evaluate(".//div[contains(@class, 'VwiC3b')]", $result)[0];

            array_push($results, 
                array (
                    "title" => htmlspecialchars($title->textContent),
                    "url" =>  htmlspecialchars($url),
                    "base_url" => htmlspecialchars(get_base_url($url)),
                    "description" =>  $description == null ? 
                                      "No description was provided for this site." : 
                                      htmlspecialchars($description->textContent)
                )
            );
        }

        return $results;
    }
?>