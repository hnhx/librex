<?php
function definition_results($response)
{
    $json_response = json_decode($response, true);

    if (!array_key_exists("title", $json_response)) {
        $definition = $json_response[0]["meanings"][0]["definitions"][0]["definition"];

        $source = "https://dictionaryapi.dev";
        return array(
            "special_response" => array(
                "response" => htmlspecialchars($definition),
                "source" => $source
            )
        );
    }
}