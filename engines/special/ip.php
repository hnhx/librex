<?php
    function ip_result()
    {
            return array(
                "special_response" => array(
                    "response" => $_SERVER["REMOTE_ADDR"],
                    "source" => null
                )
            );
    }
?>
