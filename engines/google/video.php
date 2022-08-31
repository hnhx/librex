<?php
    function get_video_results($query)
    {
        global $config;

        $url = "https://search.brave.com/videos?q=$query&source=web";
        $response = request($url);
        $xpath = get_xpath($response);

        $results = array();

        foreach($xpath->query("//div[@id='results']//div[contains(@class, 'card')]") as $result)
        {
            $url = $xpath->evaluate(".//a/@href", $result)[0];

            if ($url == null)
                continue;

            if (!empty($results)) // filter duplicate results
                if (end($results)["url"] == $url->textContent)
                    continue;

            $url = $url->textContent;
            
            $url = check_for_privacy_frontend($url);

            $title = $xpath->evaluate(".//div[contains(@class, 'title')]", $result)[0];
            $thumbnail = $xpath->evaluate(".//div[contains(@class, 'card-image')]", $result)[0];

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
                $thumbnail = urlencode($result["thumbnail"]);

                echo "<div class=\"text-result-wrapper\">";
                echo "<a href=\"$url\">";
                echo "$base_url";
                echo "<h2>$title</h2>";
                echo "</a>";
                echo "<img src=\"image_proxy.php?url=$thumbnail\">";
                echo "</div>";
            }

        echo "</div>";
    }
?>
