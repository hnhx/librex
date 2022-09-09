<?php
    function get_suggestions_results($query) {
        global $config;
        $query_encoded = urlencode($query);
        $url = "https://www.google.$config->google_domain/complete/search?q=$query_encoded&output=firefox&hl=$config->google_language";

        // Make request
        $ch = curl_init($url);
        curl_setopt_array($ch, $config->curl_settings);
        $result = curl_exec($ch);
        return $result;
    }

    function print_suggestions_results($result) {
        echo $result;
    }
