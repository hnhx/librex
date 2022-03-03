<?php
    function wikipedia_results($query, $response) 
    {
        require "config.php";
        require_once "misc/tools.php";
        
        $query_encoded = urlencode($query);

        $json_response = json_decode($response, true);

        $first_page = array_values($json_response["query"]["pages"])[0];

        if (!array_key_exists("missing", $first_page))
        {
            $description = substr($first_page["extract"], 0, 250) . "...";

            $source = "https://en.wikipedia.org/wiki/$query";
            return array(
                "special_response" => array(
                    "response" => $description,
                    "source" => $source
                )
            );
        }
    }
?>