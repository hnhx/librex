<?php

    function get_librex_results($query, $page) 
    {
        global $config;

        if (!$config->instance_fallback) 
            return array();

        $instances_json = json_decode(file_get_contents("instances.json"), true);

        if (empty($instances_json["instances"]))
            return array();


        $instances = array_map(fn($n) => $n['clearnet'], array_filter($instances_json['instances'], fn($n) => !is_null($n['clearnet'])));
        shuffle($instances);

        $query_encoded = urlencode($query);

        $results = array();
        $tries = 0;

        do {
            $tries++;

            // after "too many" requests, give up
            if ($tries > 5)
                return array();

            $instance = array_pop($instances);

            if (parse_url($instance)["host"] == parse_url($_SERVER['HTTP_HOST'])["host"])
                continue;

            $url = $instance . "api.php?q=$query_encoded&p=$page&t=0";

            $librex_ch = curl_init($url);
            curl_setopt_array($librex_ch, $config->curl_settings);
            copy_cookies($librex_ch);
            $response = curl_exec($librex_ch);
            curl_close($librex_ch);

            $code = curl_getinfo($librex_ch)["http_code"];
            $results = json_decode($response, true);

        } while ( $results == null || count($results) <= 1);

        return array_values($results);
    }
?>
