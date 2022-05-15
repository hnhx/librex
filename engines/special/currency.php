<?php
    function currency_results($query, $response)
    { 
        $split_query = explode(" ", $query);

        $base_currency = strtoupper($split_query[1]);
        $currency_to_convert = strtoupper($split_query[3]);
        $amount_to_convert = floatval($split_query[0]);   
        
        $json_response = json_decode($response, true);
                
        $rates =  $json_response["rates"];

        if (array_key_exists($base_currency, $rates) && array_key_exists($currency_to_convert, $rates))
        {
            $base_currency_response = $rates[$base_currency];
            $currency_to_convert_response = $rates[$currency_to_convert];

            $conversion_result = ($currency_to_convert_response / $base_currency_response) * $amount_to_convert;

            $formatted_response = "$amount_to_convert $base_currency = $conversion_result $currency_to_convert";
            $source = "https://moneyconvert.net/";
            return array(
                "special_response" => array(
                    "response" => htmlspecialchars($formatted_response),
                    "source" => $source
                )
            );
        }                    
    }
?>
