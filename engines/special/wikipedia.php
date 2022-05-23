<?php
    function wikipedia_results($query, $response) 
    {
        $query_encoded = urlencode($query);

        $json_response = json_decode($response, true);

        $first_page = array_values($json_response["query"]["pages"])[0];

        if (!array_key_exists("missing", $first_page))
        {
            $description = substr($first_page["extract"], 0, 250) . "...";

            $source = check_for_privacy_frontend("https://wikipedia.org/wiki/$query_encoded");
            $response = array(
                "special_response" => array(
                    "response" => htmlspecialchars($description),
                    "source" => $source
                )
            );

            if (array_key_exists("thumbnail",  $first_page))
            {
                $img_url = $first_page["thumbnail"]["source"];
                $img_src = request($img_url);
                $base64_src = base64_encode($img_src);
                $response["special_response"]["image"] = $base64_src;
            }

            return $response;
        }
    }
?>
