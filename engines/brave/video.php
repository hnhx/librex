<?php
    function get_video_results($query)
    {
        global $config;

        $url = "https://search.brave.com/videos?q=$query&source=web";
        $response = request($url);
        $xpath = get_xpath($response);

        $results = array();

        foreach($xpath->query("//div[@id='results']//div[@class='card']") as $result)
        {
            $url = $xpath->evaluate(".//a/@href", $result)[0]->textContent;
            $title = $xpath->evaluate(".//div/@title", $result)[0]->textContent;
            $views = $xpath->evaluate(".//div/@title", $result)[1]->textContent;
            $date = $xpath->evaluate(".//div//span", $result)[0]->textContent;
            $thumbnail_raw1 = $xpath->evaluate(".//div/@style", $result)[0]->textContent;
            $thumbnail_raw2 = explode("url('", $thumbnail_raw1)[1];
            $thumbnail =  explode("'), url", $thumbnail_raw2)[0];

            $url = check_for_privacy_frontend($url);

            array_push($results,
                array (
                    "title" => htmlspecialchars($title),
                    "url" =>  htmlspecialchars($url),
                    "base_url" => htmlspecialchars(get_base_url($url)),
                    "views" => htmlspecialchars($views),
                    "date" => htmlspecialchars($date),
                    "thumbnail" => htmlspecialchars($thumbnail)
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
                $views = $result["views"];
                $date = $result["date"];
                $thumbnail = $result["thumbnail"];

                echo "<div class=\"text-result-wrapper\">";
                echo "<a href=\"$url\">";
                echo "$base_url";
                echo "<h2>$title</h2>";
                echo "<img class=\"video-img\" src=\"image_proxy.php?url=$thumbnail\">";
                echo "<br>";
                echo "<span>$date - $views</span>";
                echo "</a>";
                echo "</div>";
            }

        echo "</div>";
    }
?>
