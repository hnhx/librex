<?php
    function get_base_url($url)
    {
        $split_url = explode("/", $url);
        $base_url = $split_url[0] . "//" . $split_url[2] . "/";
        return $base_url;
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
        require "config.php";

        $ch = curl_init($url);
        curl_setopt_array($ch, $config_curl_settings);
        $response = curl_exec($ch);

        return $response;
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