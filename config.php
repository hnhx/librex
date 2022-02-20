<?php
    // This user agent will be used to access Google
    $config_user_agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.81 Safari/537.36";
    
    // e.g.: fr -> https://google.fr/
    $config_google_domain = "com";

    // Results will be in this language
    $config_google_language = "en";

    /*
        youtube.com results will be replaced with the given invidious instance
        Get online invidious instances from here: https://docs.invidious.io/Invidious-Instances.md
        
        Set as null if you don't want to replace YouTube results
    */
    $config_replace_yt_with_invidious = "yewtu.be";

    /*
        To send requests trough a proxy uncomment CURLOPT_PROXY and CURLOPT_PROXYTYPE:

        CURLOPT_PROXYTYPE options:

            CURLPROXY_HTTP
            CURLPROXY_SOCKS4
            CURLPROXY_SOCKS4A
            CURLPROXY_SOCKS5
            CURLPROXY_SOCKS5_HOSTNAME

        As an example, for a TOR connection you would use these settings:
        CURLOPT_PROXY => "127.0.0.1:9050",
        CURLOPT_PROXYTYPE => CURLPROXY_SOCKS5,

        !!! ONLY CHANGE THE OTHER OPTIONS IF YOU KNOW WHAT YOU ARE DOING !!!
    */
    $config_curl_settings = array(
        // CURLOPT_PROXY => "ip:port",
        // CURLOPT_PROXYTYPE => CURLPROXY_HTTP,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_ENCODING       => "",
        CURLOPT_USERAGENT      => $config_user_agent,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_VERBOSE        => 1
    );
?>