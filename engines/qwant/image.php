<?php
    function get_image_results($query, $page) 
    {
        global $config;

        $page = $page / 10 + 1; // qwant has a different page system
        
        $url = "https://lite.qwant.com/?q=$query&t=images&p=$page";
        $response = request($url);
        $xpath = get_xpath($response);

        $results = array();

        foreach($xpath->query("//a[@rel='noopener']") as $result)
        {       
                $image = $xpath->evaluate(".//img", $result)[0];

                if ($image)
                {
                    $encoded_url = $result->getAttribute("href");
                    $encoded_url_split1 = explode("==/", $encoded_url)[1];
                    $encoded_url_split2 = explode("?position", $encoded_url_split1)[0];
                    $real_url = urldecode(base64_decode($encoded_url_split2));
                    $real_url = check_for_privacy_frontend($real_url);

                    $alt = $image->getAttribute("alt");
                    $thumbnail = urlencode($image->getAttribute("src"));

                    array_push($results, 
                        array (
                            "thumbnail" => urldecode(htmlspecialchars($thumbnail)),
                            "alt" => htmlspecialchars($alt),
                            "url" => htmlspecialchars($real_url)
                        )
                    );
    
                }
        }

        return $results;
    }

    function print_image_results($results)
    {
        echo "<div class=\"image-result-container\">";

            foreach($results as $result)
            {
                $thumbnail = urlencode($result["thumbnail"]);
                $alt = $result["alt"];
                $url = $result["url"];

                echo "<a title=\"$alt\" href=\"$url\" target=\"_blank\">";
                echo "<img src=\"image_proxy.php?url=$thumbnail\">";
                echo "</a>";
            }

        echo "</div>";
    }
?>
