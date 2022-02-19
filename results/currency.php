<?php


    function currency_results($query)
    {
        require "config.php"; 
        
        $split_query = explode(" ", $query);

        if (count($split_query) >= 4) 
        {
            $amount_to_convert = floatval($split_query[0]);   

            if ($amount_to_convert != 0) 
            {
                $base_currency = strtoupper($split_query[1]);
                $currency_to_convert = strtoupper($split_query[3]);

                $ch = curl_init("https://cdn.moneyconvert.net/api/latest.json");
                curl_setopt_array($ch, $config_curl_settings);
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
?>