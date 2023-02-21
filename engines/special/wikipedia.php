<?php
    function wikipedia_results($query, $response) 
    {
        global $config;

        $query_encoded = urlencode($query);

        $json_response = json_decode($response, true);

        $first_page = array_values($json_response["query"]["pages"])[0];

        if (!array_key_exists("missing", $first_page))
        {
            $description = substr($first_page["extract"], 0, 250) . "...";

            $wikipedia_language = isset($_COOKIE["wikipedia_language"]) ? trim(htmlspecialchars($_COOKIE["wikipedia_language"])) : $config->wikipedia_language;

            $source = check_for_privacy_frontend("https://$wikipedia_language.wikipedia.org/wiki/$query");
            $response = array(
                "special_response" => array(
                    "response" => htmlspecialchars($description),
                    "source" => $source
                )
            );

            if (array_key_exists("thumbnail",  $first_page))
            {
                $image_url = $first_page["thumbnail"]["source"];
                $response["special_response"]["image"] = $image_url;
            }

            return $response;
        }
    }
?>
