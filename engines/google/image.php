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

                if (!empty($image))
                {
                    $alt = $image->getAttribute("alt");
                    $src = $image->getAttribute("data-src");

                    if (!empty($alt)) 
                    {
                        $ch = curl_init($src);
                        curl_setopt_array($ch, $config->curl_settings);
                        array_push($chs, $ch);
                        curl_multi_add_handle($mh, $ch);

                        array_push($results, 
                            array (
                                "base64" => "",
                                "alt" => htmlspecialchars($alt),
                                "url" => htmlspecialchars($url)
                            )
                        );
                    }
                }
        }

        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        for ($i=0; count($chs)>$i; $i++)
        {
            $img_base64 = base64_encode(curl_multi_getcontent($chs[$i]));
            $results[$i]["base64"] = $img_base64;
        }

        return $results;
    }

    function print_image_results($results)
    {
        echo "<div class=\"image-result-container\">";

            foreach($results as $result)
            {
                $src = $result["base64"];
                $alt = $result["alt"];
                $url = $result["url"];

                echo "<a title=\"$alt\" href=\"$url\" target=\"_blank\">";
                echo "<img src=\"data:image/jpeg;base64,$src\" height=\"200\">";
                echo "</a>";
            }

        echo "</div>";
    }
?>
