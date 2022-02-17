<?php
        function get_base_url($url)
        {
            $split_url = explode("/", $url);
            $base_url = $split_url[0] . "//" . $split_url[2] . "/";
            return $base_url;
        }

        function fetch_results($query, $page, $get_images=false) 
        {
            require("config.php");

            $query_encoded =  urlencode($query);

            $google = "https://www.google.$config_google_domain/search?&q=$query_encoded&start=$page&hl=$config_google_language";
            if ($get_images)
                $google .= "&tbm=isch";

            $ch = curl_init($google);

            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                // CURLOPT_PROXYTYPE      => CURLPROXY_SOCKS5_HOSTNAME,
                // CURLOPT_PROXY          => "127.0.0.1:9150",
                CURLOPT_HEADER         => false,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_ENCODING       => "",
                CURLOPT_USERAGENT      => $config_user_agent,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_VERBOSE        => 1,
            ]);

            $response = curl_exec($ch);
            
            $htmlDom = new DOMDocument;
            @$htmlDom->loadHTML($response);
            $xpath = new DOMXPath($htmlDom);
            
            $results = array();

            if ($get_images)
            {

                $mh = curl_multi_init();
                $chs = array();

                foreach($xpath->query(".//following::img") as $image)
                {       
                        $alt = $image->getAttribute("alt");
                        $src = $image->getAttribute("data-src");

                        if (!empty($src) && !empty($alt)) 
                        {
                            $ch = curl_init($src);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            array_push($chs, $ch);
                            curl_multi_add_handle($mh, $ch);
                        }
                }

                $running = null;
                do {
                    curl_multi_exec($mh, $running);
                } while ($running);

                foreach($chs as $ch)
                {
                    $img_base64 = base64_encode(curl_multi_getcontent($ch));
                    array_push($results, 
                        array (
                            "base64" => $img_base64,
                            "alt" => $alt
                        )
                    );
                }

            } 
            else
            {
                foreach($xpath->query("//div[contains(@class, 'yuRUbf')]") as $div)
                {
                    $title = $div->getElementsByTagName("h3")[0]->textContent;
                    $url = $div->getElementsByTagName("a")[0]->getAttribute("href");
                    $base_url =  get_base_url($url);

                    array_push($results, 
                        array (
                            "title" => $title,
                            "url" =>  $url,
                            "base_url" => $base_url
                        )
                    );
                }
            } 

            return $results;
        }
?>