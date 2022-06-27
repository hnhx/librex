<?php
    function get_image_results($query) 
    {
        global $config;

        $url = "https://www.google.$config->google_domain/search?&q=$query&hl=$config->google_language&tbm=isch";
        $response = request($url);
        $xpath = get_xpath($response);

        $mh = curl_multi_init();
        $chs = $results = array();

        foreach($xpath->query("//div[@class='isv-r PNCib MSM1fd BUooTd']") as $result)
        {       
                $image = $xpath->evaluate(".//img[@data-src]", $result)[0];

                $url = $xpath->evaluate(".//a/@href", $result)[0]->textContent;
                $url = check_for_privacy_frontend($url);

                if (!empty($image))
                {
                    $alt = $image->getAttribute("alt");
                    $thumbnail = $image->getAttribute("data-src");
                    
                    if (!empty($alt)) 
                    {
                        array_push($results, 
                            array (
                                "thumbnail" => $thumbnail,
                                "alt" => htmlspecialchars($alt),
                                "url" => htmlspecialchars($url)
                            )
                        );
                    }
                }
        }

        return $results;
    }

    function print_image_results($results)
    {
        echo "<div class=\"image-result-container\">";

            foreach($results as $result)
            {
                $thumbnail = $result["thumbnail"];
                $alt = $result["alt"];
                $url = $result["url"];

                echo "<a title=\"$alt\" href=\"$url\" target=\"_blank\">";
                echo "<img src=\"engines/google/image_proxy.php?url=$thumbnail\">";
                echo "</a>";
            }

        echo "</div>";
    }
?>
