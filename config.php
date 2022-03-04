<?php
    // This user agent will be used when parsing the results
    $config_user_agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36";
    
    // e.g.: fr -> https://google.fr/
    $config_google_domain = "com";

    // Google results will be in this language
    $config_google_language = "en";

    $config_disable_bittorent_search = false;
    $config_bittorent_trackers = "&tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&tr=udp%3A%2F%2Fopen.stealth.si%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&tr=udp%3A%2F%2Fexodus.desync.com%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.torrent.eu.org%3A451%2Fannounce";

    /*
        These are privacy friendly front-ends for popular sites

        Online invidious instances: https://docs.invidious.io/Invidious-Instances.md
        Online bibliogram instances: https://git.sr.ht/~cadence/bibliogram-docs/tree/master/docs/Instances.md
        Online nitter instances: https://github.com/zedeus/nitter/wiki/Instances
        Online libreddit instances: https://github.com/spikecodes/libreddit
        
        If you don't want to replace YouTube for an example but you want to replace everything else:
        $config_replace_youtube_with_invidious = null;
    */
    $config_disable_privacy_friendly_frontends = false; // setting this to true will disable all of them
    $config_replace_youtube_with_invidious = "https://yewtu.be";
    $config_replace_instagram_with_bibliogram = "https://bibliogram.pussthecat.org";
    $config_replace_twitter_with_nitter = "https://nitter.namazso.eu";
    $config_replace_reddit_with_libreddit = "https://libreddit.dothq.co";

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
        CURLOPT_ENCODING => "",
        CURLOPT_USERAGENT => $config_user_agent,
        CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYSTATUS => false,
        CURLOPT_VERBOSE => false,
        CURLOPT_TCP_FASTOPEN => true
    );
?>