<?php
    function tor_result($response)
    {
            $formatted_response = "It seems like you are not using Tor";
            if (strpos($response, $_SERVER["REMOTE_ADDR"]) !== false)
            {
                $formatted_response = "It seems like you are using Tor";
            }

            $source = "https://check.torproject.org";
            return array(
                "special_response" => array(
                    "response" => $formatted_response,
                    "source" => $source
                )
            );
    }
?>
