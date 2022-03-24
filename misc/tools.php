<?php
    function get_base_url($url)
    {
        $split_url = explode("/", $url);
        $base_url = $split_url[0] . "//" . $split_url[2] . "/";
        return $base_url;
    }

    function check_for_privacy_friendly_alternative($url, $frontend, $tobereplaced)
    {
        if (isset($_COOKIE[$frontend]) || isset($_REQUEST[$frontend]))
        {
            $frontend = isset($_COOKIE[$frontend]) ? $_COOKIE[$frontend] : $_REQUEST[$frontend];

            if ($tobereplaced == "instagram.com") 
            {
                if (!strpos($url, "/p/"))
                    $frontend .= "/u";
            }
           
            $url =  $frontend . explode($tobereplaced, $url)[1];

            return $url;
        }

        return $url;
    }

    function privacy_friendly_alternative($url)
    {
       if (strpos($url, "youtube.com"))
            $url = check_for_privacy_friendly_alternative($url, "invidious", "youtube.com");
        else if (strpos($url, "instagram.com"))
            $url = check_for_privacy_friendly_alternative($url, "bibliogram", "instagram.com");
        else if (strpos($url, "twitter.com"))
            $url = check_for_privacy_friendly_alternative($url, "nitter", "twitter.com");
        else if (strpos($url, "reddit.com"))
            $url = check_for_privacy_friendly_alternative($url, "libreddit", "reddit.com");

        return $url;
    }

    function get_xpath($response)
    {
        $htmlDom = new DOMDocument;
        @$htmlDom->loadHTML($response);
        $xpath = new DOMXPath($htmlDom);

        return $xpath;
    }

    function request($url)
    {
        global $config;

        $ch = curl_init($url);
        curl_setopt_array($ch, $config->curl_settings);
        $response = curl_exec($ch);

        return $response;
    }

    function human_filesize($bytes, $dec = 2)
    {
        $size   = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$dec}f ", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    function remove_special($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
     }

    function print_elapsed_time($start_time)
        {
            $end_time = number_format(microtime(true) - $start_time, 2, '.', '');
            echo "<p id=\"time\">Fetched the results in $end_time seconds</p>";
        }

    function print_next_page_button($text, $page, $query, $type)
    {
        echo "<form id=\"page\" action=\"search.php\" target=\"_top\" method=\"post\" enctype=\"multipart/form-data\" autocomplete=\"off\">";
        echo "<input type=\"hidden\" name=\"p\" value=\"" . $page . "\" />";
        echo "<input type=\"hidden\" name=\"q\" value=\"$query\" />";
        echo "<input type=\"hidden\" name=\"type\" value=\"$type\" />";
        echo "<button type=\"submit\">$text</button>";
        echo "</form>";
    }
?>
