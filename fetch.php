<?php
        require("config.php");

        $proxy_type = null;
        if ($config_proxy != null)
        {
            switch($config_proxy_type)
            {
                case 1:
                    $proxy_type = CURLPROXY_HTTP;
                    break;
                case 2:
                    $proxy_type = CURLPROXY_SOCKS4;
                    break;
                case 3:
                    $proxy_type = CURLPROXY_SOCKS4A;
                    break;
                case 4:
                    $proxy_type = CURLPROXY_SOCKS5;
                    break;
                case 5:
                    $proxy_type = CURLPROXY_SOCKS5_HOSTNAME;
                    break;
                default:
                    $proxy_type = CURLPROXY_HTTP;
                    break;
            }
        }

        $curl_settings = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_ENCODING       => "",
            CURLOPT_USERAGENT      => $config_user_agent,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_VERBOSE        => 1
        );

        function get_base_url($url)
        {
            $split_url = explode("/", $url);
            $base_url = $split_url[0] . "//" . $split_url[2] . "/";
            return $base_url;
        }

        function special_search($query) 
        {
            $query_lower = strtolower($query);

            // Check for currency convesion
            if (strpos($query_lower, "to"))
                convert_currency($query);
            
            // Check for definition 
            else if (strpos($query_lower, "mean"))
                define_word($query);
        }

        function convert_currency($query)
        {

            global $curl_settings , $proxy_type , $config_proxy; 

            $split_query = explode(" ", $query);

            if (count($split_query) >= 4) 
            {
                $amount_to_convert =  floatval($split_query[0]);   

                if ($amount_to_convert != 0) 
                {
                    $base_currency = strtoupper($split_query[1]);
                    $currency_to_convert = strtoupper($split_query[3]);

                    $ch = curl_init("https://cdn.moneyconvert.net/api/latest.json");
                    if ($config_proxy != null)
                    {
                        curl_setopt($ch, CURLOPT_PROXY, $config_proxy);
                        curl_setopt($ch, CURLOPT_PROXYTYPE, $proxy_type);
                    }
                    curl_setopt_array($ch, $curl_settings);
                    $response = curl_exec($ch);
                    $json_response = json_decode($response, true);
                    
                    $rates =  $json_response["rates"];

                    if (array_key_exists($base_currency, $rates) && array_key_exists($currency_to_convert, $rates))
                    {
                        $base_currency_response = $rates[$base_currency];
                        $currency_to_convert_response = $rates[$currency_to_convert];
    
                        $conversion_result = ($currency_to_convert_response / $base_currency_response) * $amount_to_convert;
    
                        echo "<p id=\"special-result\">";
                        echo  "$amount_to_convert $base_currency = $conversion_result $currency_to_convert";
                        echo "</p>";
                    }                    
                }
            }
        }

        function define_word($query) 
        {
            global $curl_settings , $proxy_type , $config_proxy; 
            
            $split_query = explode(" ", $query);
            
            if (count($split_query) >= 2)
            {
                $reversed_split_q = array_reverse($split_query);
                $word_to_define = $reversed_split_q[1];

                $ch = curl_init("https://api.dictionaryapi.dev/api/v2/entries/en/$word_to_define");
                if ($config_proxy != null)
                {
                    curl_setopt($ch, CURLOPT_PROXY, $config_proxy);
                    curl_setopt($ch, CURLOPT_PROXYTYPE, $proxy_type);
                }
                curl_setopt_array($ch, $curl_settings);
                $response = curl_exec($ch);
                $json_response = json_decode($response, true);

                if (!array_key_exists("title", $json_response))
                {
                    $definition = $json_response[0]["meanings"][0]["definitions"][0]["definition"];

                    echo "<p id=\"special-result\">";
                    echo "$word_to_define meaning<br/>";
                    echo "<br/>" . $definition . "<br/>";
                    echo "</p>";
                }
            }
        }

        function fetch_results($query, $page, $get_images=false) 
        {

            global $curl_settings , $proxy_type , $config_proxy; 

            require "config.php";

            $query_encoded =  urlencode($query);

            $google = "https://www.google.$config_google_domain/search?&q=$query_encoded&start=$page&hl=$config_google_language";
            if ($get_images)
                $google .= "&tbm=isch";
                
            $ch = curl_init($google);

            if ($config_proxy != null)
            {
                curl_setopt($ch, CURLOPT_PROXY, $config_proxy);
                curl_setopt($ch, CURLOPT_PROXYTYPE, $proxy_type);
            }
            curl_setopt_array($ch, $curl_settings);

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
                            if ($config_proxy != null)
                            {
                                curl_setopt($ch, CURLOPT_PROXY, $config_proxy);
                                curl_setopt($ch, CURLOPT_PROXYTYPE, $proxy_type);
                            }
                            curl_setopt_array($ch, $curl_settings);
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