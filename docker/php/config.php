<?php
    return (object) array(
        "google_domain" => "${CONFIG_GOOGLE_DOMAIN}",
        "google_language_site" => "${CONFIG_GOOGLE_LANGUAGE_SITE}",
        "google_language_results" => "${CONFIG_GOOGLE_LANGUAGE_RESULTS}",

        "wikipedia_language" => "${CONFIG_WIKIPEDIA_LANGUAGE}",
        "invidious_instance_for_video_results" => "${CONFIG_INVIDIOUS_INSTANCE}",

        "disable_bittorent_search" => ${CONFIG_DISABLE_BITTORRENT_SEARCH},
        "bittorent_trackers" => "${CONFIG_BITTORRENT_TRACKERS}",
        "disable_hidden_service_search" => ${CONFIG_HIDDEN_SERVICE_SEARCH},

        "frontends" => array(
            "invidious" => array(
                "instance_url" => "${APP_INVIDIOUS}",
                "project_url" => "https://docs.invidious.io/instances/",
                "original_name" => "YouTube",
                "original_url" => "youtube.com"
            ),
            "bibliogram" => array(
                "instance_url" => "${APP_BIBLIOGRAM}",
                "project_url" => "https://git.sr.ht/~cadence/bibliogram-docs/tree/master/docs/Instances.md",
                "original_name" => "Instagram",
                "original_url" => "instagram.com"
            ),
            "rimgo" => array(
                "instance_url" => "${APP_RIMGO}",
                "project_url" => "https://codeberg.org/video-prize-ranch/rimgo#instances",
                "original_name" => "Imgur",
                "original_url" => "imgur.com"
            ),
            "scribe" => array(
                "instance_url" => "${APP_SCRIBE}",
                "project_url" => "https://git.sr.ht/~edwardloveall/scribe/tree/main/docs/instances.md",
                "original_name" => "Medium",
                "original_url" => "medium.com"
            ),
            "gothub" => array(
                "instance_url" => "${APP_GOTHUB}",
                "project_url" => "https://codeberg.org/gothub/gothub/wiki/Instances",
                "original_name" => "GitHub",
                "original_url" => "github.com"
            ),
            "librarian" => array(
                "instance_url" => "${APP_LIBRARIAN}",
                "project_url" => "https://codeberg.org/librarian/librarian#clearnet",
                "original_name" => "Odysee",
                "original_url" => "odysee.com"
            ),

            "nitter" => array(
                "instance_url" => "${APP_NITTER}",
                "project_url" => "https://github.com/zedeus/nitter/wiki/Instances",
                "original_name" => "Twitter",
                "original_url" => "twitter.com"
            ),

            "libreddit" => array(
                "instance_url" => "${APP_LIBREREDDIT}",
                "project_url" => "https://github.com/spikecodes/libreddit",
                "original_name" => "Reddit",
                "original_url" => "reddit.com"
            ),
            "proxitok" => array(
                "instance_url" => "${APP_PROXITOK}",
                "project_url" => "https://github.com/pablouser1/ProxiTok/wiki/Public-instances",
                "original_name" => "TikTok",
                "original_url" => "tiktok.com"
            ),
            "wikiless" => array(
                "instance_url" => "${APP_WIKILESS}",
                "project_url" => "https://github.com/Metastem/wikiless#instances",
                "original_name" => "Wikipedia",
                "original_url" => "wikipedia.com"
            ),
            "quetre" => array(
                "instance_url" => "${APP_QUETRE}",
                "project_url" => "https://github.com/zyachel/quetre",
                "original_name" => "Quora",
                "original_url" => "quora.com"
            ),
            "libremdb" => array(
                "instance_url" => "${APP_LIBREMDB}",
                "project_url" => "https://github.com/zyachel/libremdb",
                "original_name" => "IMDb",
                "original_url" => "imdb.com"
            ),
            "breezewiki" => array(
                "instance_url" => "${APP_BREEZEWIKI}",
                "project_url" => "https://gitdab.com/cadence/breezewiki",
                "original_name" => "Fandom",
                "original_url" => "fandom.com"
            ),
            "anonymousoverflow" => array(
                "instance_url" => "${APP_ANONYMOUS_OVERFLOW}",
                "project_url" => "https://github.com/httpjamesm/AnonymousOverflow#clearnet-instances",
                "original_name" => "StackOverflow",
                "original_url" => "stackoverflow.com"
            )
        ),

        "curl_settings" => array(
            CURLOPT_PROXY => "${CURLOPT_PROXY}",
            CURLOPT_PROXYTYPE => CURLPROXY_HTTP,
            CURLOPT_RETURNTRANSFER => ${CURLOPT_RETURNTRANSFER},
            CURLOPT_ENCODING => "${CURLOPT_ENCODING}",
            CURLOPT_USERAGENT => "${CURLOPT_USERAGENT}",
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_WHATEVER,
            CURLOPT_CUSTOMREQUEST => "${CURLOPT_CUSTOMREQUEST}",
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS | CURLPROTO_HTTP,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS | CURLPROTO_HTTP,
            CURLOPT_MAXREDIRS => ${CURLOPT_MAXREDIRS},
            CURLOPT_TIMEOUT => ${CURLOPT_TIMEOUT},
            CURLOPT_VERBOSE => ${CURLOPT_VERBOSE}
        )
    );
?>
