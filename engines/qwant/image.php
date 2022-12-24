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
        echo "<div class=\"result-container__inner\">";
        echo "<div class=\"image-result-container\">";

            foreach($results as $result)
            {
                $thumbnail = urlencode($result["thumbnail"]);
                $alt = $result["alt"];
                $url = $result["url"];

                $parsed_url = parse_url($url);
                $host = $parsed_url['host'];

                // Extract the domain name from the host
                $url_trunc = preg_replace('/^www\./', '', $host);

                echo "<a title=\"$alt\" href=\"$url\" target=\"_blank\">";
                echo "<div class=\"image-wrapper\">";
                echo "<img src=\"image_proxy.php?url=$thumbnail\">";
                echo "</div>";
                echo "<span class=\"image-properties\">";
                echo "<span class=\"image-url\">$url_trunc</span>";
                echo "<h4 class=\"image-title\">$alt</h4>";
                echo "</span>";
                echo "</a>";
            }

        echo "</div>";
    }
?>
