<?php
    // This user agent will be used to access Google
    $config_user_agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.81 Safari/537.36";
    
    // e.g.: fr -> https://google.fr/
    $config_google_domain = "com";

    // Results will be in this language
    $config_google_language = "en";

    /*
        Format: "ip:port"
        
        For a TOR connection you would use these settings:
        $config_proxy = "127.0.0.1:9050";
        $config_proxy_type = 5;
    */
    $config_proxy = null;

    /* 
        1 -> HTTP
        2 -> SOCKS4
        3 -> SOCKS4a (resolves URL hostname)
        4 -> SOCKS5
        5 -> SOCKS5 (resolves URL hostname)
    */
    $config_proxy_type = 1;
?>