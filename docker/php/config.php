<?php
    return (object) array(
        "google_domain" => "${CONFIG_GOOGLE_DOMAIN}",
        "google_language" => "${CONFIG_GOOGLE_LANGUAGE}",
        "invidious_instance_for_video_results" => "${CONFIG_INVIDIOUS_INSTANCE}",

        "disable_bittorent_search" => ${CONFIG_DISABLE_BITTORRENT_SEARCH},
        "bittorent_trackers" => "${CONFIG_BITTORRENT_TRACKERS}",
        "disable_hidden_service_search" => ${CONFIG_HIDDEN_SERVICE_SEARCH},

        "invidious" => "${APP_INVIDIOUS}", // youtube
        "bibliogram" => "${APP_BIBLIOGRAM}", // instagram
        "rimgo" => "${APP_RIMGO}", // imgur
        "scribe" => "${APP_SCRIBE}", // medium
        "librarian" => "${APP_LIBRARIAN}", // odysee
        "gothub" => "${APP_GOTHUB}", // github
        "nitter" => "${APP_NITTER}", // twitter
        "libreddit" => "${APP_LIBREREDDIT}", // reddit
        "proxitok" => "${APP_PROXITOK}", // tiktok
        "wikiless" => "${APP_WIKILESS}", // wikipedia
        "quetre" => "${APP_QUETRE}", // quora
        "libremdb" => "${APP_LIBREMDB}", // imdb,
        "breezewiki" => "${APP_BREEZEWIKI}", // fandom,
        "anonymousoverflow" => "${APP_ANONYMOUS_OVERFLOW}", // stackoverflow

        "curl_settings" => array(
            CURLOPT_PROXY => "",
            CURLOPT_PROXYTYPE => CURLPROXY_HTTP,
            CURLOPT_RETURNTRANSFER => ${CURLOPT_RETURNTRANSFER},
            CURLOPT_ENCODING => "${CURLOPT_ENCODING}",
            CURLOPT_USERAGENT => "${CURLOPT_USERAGENT}",
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            CURLOPT_CUSTOMREQUEST => "${CURLOPT_CUSTOMREQUEST}",
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS | CURLPROTO_HTTP,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS | CURLPROTO_HTTP,
            CURLOPT_MAXREDIRS => ${CURLOPT_MAXREDIRS},
            CURLOPT_TIMEOUT => ${CURLOPT_TIMEOUT},
            CURLOPT_VERBOSE => ${CURLOPT_VERBOSE}
        )

    );
?>
