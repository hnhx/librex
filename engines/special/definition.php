<?php
    function definition_results($query, $response) 
    {        
            $split_query = explode(" ", $query);
            $reversed_split_q = array_reverse($split_query);
            $word_to_define = $reversed_split_q[1];

            $json_response = json_decode($response, true);

            if (!array_key_exists("title", $json_response))
            {
                $definition = $json_response[0]["meanings"][0]["definitions"][0]["definition"];

                $source = "https://en.wikipedia.org/wiki/$query";
                return array(
                    "special_response" => array(
                        "response" => $definition,
                        "source" => $source
                    )
                );
            }
        
    }
?>