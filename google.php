<?php
        function get_google_results($query, $page, $type=0) 
        {
            require "config.php";
            require_once "results/image.php";
            require_once "results/text.php";
            require_once "results/video.php"; 

            $query_encoded =  urlencode($query);

            $google = "https://www.google.$config_google_domain/search?&q=$query_encoded&start=$page&hl=$config_google_language";
            if ($type == 1)
                $google .= "&tbm=isch";
            else if ($type == 2)
                $google .= "&tbm=vid";
                
            $ch = curl_init($google);
            curl_setopt_array($ch, $config_curl_settings);
            $response = curl_exec($ch);

            if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200)
            {
                echo "<p id=\"special-result\">";
                echo "Google rejected the request! :C";
                echo "</p>";
                die();
            }

            $htmlDom = new DOMDocument;
            @$htmlDom->loadHTML($response);
            $xpath = new DOMXPath($htmlDom);

            switch ($type)
            {
                case 0: 
                    return text_results($xpath); 
                case 1: 
                    return image_results($xpath);
                case 2: 
                    return video_results($xpath);
                default: 
                    return text_results($xpath);
            }
        }
?>