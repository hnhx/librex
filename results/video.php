<?php
    function video_results($xpath)
    {
        require_once "tools.php";
        require "config.php";

        $results = array();

        foreach($xpath->query("//div[@id='search']//div[contains(@class, 'g')]") as $result)
        {
            $url = $xpath->evaluate(".//a/@href", $result)[0];

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
            
            array_push($results, 
                array (
                    "title" => $title->textContent,
                    "url" =>  $url,
                    "base_url" => get_base_url($url)
                )
            );
        }

        return $results;
    }
?>