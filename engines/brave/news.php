<?php
    function get_news_results($query)
    {
        global $config;

        $url = "https://search.brave.com/news?q=$query&source=web";
        $response = request($url);
        $xpath = get_xpath($response);

        $results = array();

        foreach($xpath->query("//div[@id='results']//div[contains(@class, 'snippet')]") as $result)
        {
            $url = $xpath->evaluate(".//a/@href", $result)[0];

            if ($url == null)
                continue;

            if (!empty($results)) // filter duplicate results
                if (end($results)["url"] == $url->textContent)
                    continue;

            $url = $url->textContent;
            
            $url = check_for_privacy_frontend($url);

            $title = $xpath->evaluate(".//span[contains(@class, 'snippet-title')]", $result)[0];
            $description = $xpath->evaluate(".//p[contains(@class, 'snippet-description')]", $result)[0];

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

    function print_news_results($results)
    {
        echo "<div class=\"text-result-container\">";

            foreach($results as $result)
            {
                $title = $result["title"];
                $url = $result["url"];
                $base_url = $result["base_url"];
                $description = $result["description"];

                echo "<div class=\"text-result-wrapper\">";
                echo "<a href=\"$url\">";
                echo "$base_url";
                echo "<h2>$title</h2>";
                echo "</a>";
                echo "<span>$description</span>";
                echo "</div>";
            }

        echo "</div>";
    }
?>
