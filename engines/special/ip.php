<?php
    function ip_result()
    {
            $ip = $_SERVER["REMOTE_ADDR"];

            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $ip = reset(explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]));
            }

            return array(
                "special_response" => array(
                    "response" => $ip,
                    "source" => null
                )
            );
    }
?>
