<?php
     function check_for_special_search($query)
     {
         $query_lower = strtolower($query);
         $split_query = explode(" ", $query);

         if (strpos($query_lower, "to") && count($split_query) >= 4) // currency
         {
            $amount_to_convert = floatval($split_query[0]);   
            if ($amount_to_convert != 0) 
                return 1;
         }
         else if (strpos($query_lower, "mean") && count($split_query) >= 2) // definition
             return 2;
         else if (3 > count(explode(" ", $query))) // wikipedia
             return 3;

        return 0;
     }

    function get_text_results($query, $page=0, $api=false) 
    {
        require "config.php";
        require "misc/tools.php";

        $mh = curl_multi_init();
        $query_lower = strtolower($query);
        $query_encoded = urlencode($query);
        $results = array();
        
        $url = "https://www.google.$config_google_domain/search?&q=$query_encoded&start=$page&hl=$config_google_language";
        $google_ch = curl_init($url);
        curl_setopt_array($google_ch, $config_curl_settings);
        curl_multi_add_handle($mh, $google_ch);
 

        $special_search = $page == 0 ? check_for_special_search($query) : 0;
        $special_ch = null;
        $url = null;
        if ($special_search != 0)
        {
            switch ($special_search)
            {
                case 1:
                    $url = "https://cdn.moneyconvert.net/api/latest.json";
                    break;
                case 2:
                    $split_query = explode(" ", $query);
                    $reversed_split_q = array_reverse($split_query);
                    $word_to_define = $reversed_split_q[1];
                    $url = "https://api.dictionaryapi.dev/api/v2/entries/en/$word_to_define";
                    break;
                case 3:
                    $url = "https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&explaintext&redirects=1&titles=$query_encoded";
                    break;
            }

            $special_ch = curl_init($url);
            curl_setopt_array($special_ch, $config_curl_settings);
            curl_multi_add_handle($mh, $special_ch);
        }


        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);
       
        if ($special_search != 0 && $api == false)
        {
            switch ($special_search)
            {
                case 1:
                    require "engines/special/currency.php";
                    array_push($results, currency_results($query, curl_multi_getcontent($special_ch)));
                    break;
                case 2:
                    require "engines/special/definition.php";
                    array_push($results, definition_results($query, curl_multi_getcontent($special_ch)));
                    break;
                case 3:
                    require "engines/special/wikipedia.php";
                    array_push($results, wikipedia_results($query, curl_multi_getcontent($special_ch)));
                    break;
            }
        }

        $xpath = get_xpath(curl_multi_getcontent($google_ch));

        foreach($xpath->query("//div[@id='search']//div[contains(@class, 'g')]") as $result)
        {
            $url = $xpath->evaluate(".//div[@class='yuRUbf']//a/@href", $result)[0];

            if ($url == null)
                continue;

            if (!empty($results)) // filter duplicate results, ignore special result
            {
                if (!array_key_exists("special_response", end($results)))
                    if (end($results)["url"] == $url->textContent)
                        continue;
            }
               

            $url = $url->textContent;
            $url = check_for_privacy_friendly_alternative($url);
            
            $title = $xpath->evaluate(".//h3", $result)[0];
            $description = $xpath->evaluate(".//div[contains(@class, 'VwiC3b')]", $result)[0];

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

    function print_text_results($results) 
    {
        echo "<div class=\"text-result-container\">";

        $special = $results[0];
        if (array_key_exists("special_response", $special))
        {
            $response = $special["special_response"]["response"];
            $source = $special["special_response"]["source"];

            echo "<p class=\"special-result-container\">";
            echo $response;
            echo "<a href=\"$source\" target=\"_blank\">$source</a>";
            echo "</p>";

            array_shift($results);
        }

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