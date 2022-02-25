<?php
    function get_video_results($query, $page=0)
    {
        require "config.php";
        require "misc/tools.php";
        
        $url = "https://www.google.$config_google_domain/search?&q=$query&start=$page&hl=$config_google_language&tbm=vid";
        $response = request($url);
        $xpath = get_xpath($response);

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
                    "title" => htmlspecialchars($title->textContent),
                    "url" =>  htmlspecialchars($url),
                    "base_url" => htmlspecialchars(get_base_url($url))
                )
            );
        }

        return $results;
    }

    function print_video_results($results)
    {
        echo "<div class=\"text-result-container\">";

            foreach($results as $result)
            {
                $title = $result["title"];
                $url = $result["url"];
                $base_url = $result["base_url"];

                echo "<div class=\"text-result-wrapper\">";
                echo "<a href=\"$url\">";
                echo "$base_url";
                echo "<h2>$title</h2>";
                echo "</a>";
                echo "</div>";
            }

        echo "</div>";
    }
?>