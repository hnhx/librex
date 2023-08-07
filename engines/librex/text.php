<?php
    function get_librex_results($query, $page) 
    {
        global $config;

        if (!$config->instance_fallback) 
        {
            return array();
        }

        $instances_json = json_decode(file_get_contents("instances.json"), true);
        $instances = array_map(fn($n) => $n['clearnet'], array_filter($instances_json['instances'], fn($n) => !is_null($n['clearnet'])));
        $query_encoded = urlencode($query);

        $results = array();

        do {
            $instance = $instances[array_rand($instances)];
            $url = $instance . "api.php?q=$query_encoded&p=$page&t=0";

            $librex_ch = curl_init($url);
            curl_setopt_array($librex_ch, $config->curl_settings);
            $response = curl_exec($librex_ch);
            curl_close($librex_ch);
            $code = curl_getinfo($librex_ch)["http_code"];
            $results = json_decode($response, true);

        } while ( $results == null || count($results) <= 1);

        return array_values($results);
    }
?>
