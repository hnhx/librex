#!/bin/sh

# YOU DON'T NEED TO EDIT THIS FILE. IF YOU WANT TO SET CUSTOM ENVIRONMENT VARIABLES,
# USE THE 'DOCKERFILE IMAGE' FROM ROOT DIRECTORY AND PASS THE ENVIRONMENT PARAMETERS

# These templates will be used to create configuration files that incorporate values from environment variables
# If these locations do not already exist within the Docker container, they will be created
export CONFIG_PHP_TEMPLATE="$(pwd)/config.php"
export CONFIG_OPEN_SEARCH_TEMPLATE="$(pwd)/opensearch.xml"
export CONFIG_NGINX_TEMPLATE="/etc/nginx/http.d/librex.conf"

# Configure 'opensearch.xml' with Librex configuration metadata, such as the encoding and the host that stores the site
# These configurations will replace the 'opensearch.xml' inside '.dockers/templates' for the best setup for your instance
export OPEN_SEARCH_TITLE=${OPEN_SEARCH_TITLE:-"LibreX"}
export OPEN_SEARCH_DESCRIPTION=${OPEN_SEARCH_DESCRIPTION:-"Framework and javascript free privacy respecting meta search engine"}
export OPEN_SEARCH_ENCODING=${OPEN_SEARCH_ENCODING:-"UTF-8"}
export OPEN_SEARCH_LONG_NAME=${OPEN_SEARCH_LONG_NAME:-"LibreX Search"}
export OPEN_SEARCH_HOST=${OPEN_SEARCH_HOST:-"127.0.0.1"}

# Replace the 'config.php' script, which contains the most common search engine configurations, with these environment setups
# These environment setups can be found in 'config.php', and the default configurations can be useful for most use cases
# allowed domains from https://www.google.com/supported_domains
export CONFIG_GOOGLE_ALLOWED_DOMAINS=${CONFIG_GOOGLE_ALLOWED_DOMAINS:-"com ad ae com.af com.ag com.ai al am co.ao com.ar as at com.au az ba com.bd be bf bg com.bh bi bj com.bn com.bo com.br bs bt co.bw by com.bz ca cd cf cg ch ci co.ck cl cm cn com.co co.cr com.cu cv com.cy cz de dj dk dm com.do dz com.ec ee com.eg es com.et fi com.fj fm fr ga ge gg com.gh com.gi gl gm gr com.gt gy com.hk hn hr ht hu co.id ie co.il im co.in iq is it je com.jm jo co.jp co.ke com.kh ki kg co.kr com.kw kz la com.lb li lk co.ls lt lu lv com.ly co.ma md me mg mk ml com.mm mn ms com.mt mu mv mw com.mx com.my co.mz com.na com.ng com.ni ne nl no com.np nr nu co.nz com.om com.pa com.pe com.pg com.ph com.pk pl pn com.pr ps pt com.py com.qa ro ru rw com.sa com.sb sc se com.sg sh si sk com.sl sn so sm sr st com.sv td tg co.th com.tj tl tm tn to com.tr tt com.tw co.tz com.ua co.ug co.uk com.uy co.uz com.vc co.ve vg co.vi com.vn vu ws rs co.za co.zm co.zw cat"}
export CONFIG_GOOGLE_DOMAIN=${CONFIG_GOOGLE_DOMAIN:-"com"}
export CONFIG_GOOGLE_LANGUAGE_SITE=${CONFIG_GOOGLE_LANGUAGE_SITE:-"en"}
export CONFIG_GOOGLE_LANGUAGE_RESULTS=${CONFIG_GOOGLE_LANGUAGE_RESULTS:-""}
export CONFIG_INVIDIOUS_INSTANCE=${CONFIG_INVIDIOUS_INSTANCE:-"invidious.namazso.eu"}
export CONFIG_HIDDEN_SERVICE_SEARCH=${CONFIG_HIDDEN_SERVICE_SEARCH:-false}
export CONFIG_DISABLE_BITTORRENT_SEARCH=${CONFIG_DISABLE_BITTORRENT_SEARCH:-false}
export CONFIG_BITTORRENT_TRACKERS=${CONFIG_BITTORRENT_TRACKERS:-"&tr=http://nyaa.tracker.wf:7777/announce&tr=udp://open.stealth.si:80/announce&tr=udp://tracker.opentrackr.org:1337/announce&tr=udp://exodus.desync.com:6969/announce&tr=udp://tracker.torrent.eu.org:451/announce"}

# Supported apps integration configuration. These empty spaces can be set up using free hosts as pointers
# A particular example is using the "https://yewtu.be" or a self-hosted host to integrate the invidious app to librex
export APP_INVIDIOUS=${APP_INVIDIOUS:-""}
export APP_BIBLIOGRAM=${APP_BIBLIOGRAM:-""}
export APP_RIMGO=${APP_RIMGO:-""}
export APP_SCRIBE=${APP_SCRIBE:-""}
export APP_LIBRARIAN=${APP_LIBRARIAN:-""}
export APP_GOTHUB=${APP_GOTHUB:-""}
export APP_NITTER=${APP_NITTER:-""}
export APP_LIBREREDDIT=${APP_LIBREREDDIT:-""}
export APP_PROXITOK=${APP_PROXITOK:-""}
export APP_WIKILESS=${APP_WIKILESS:-""}
export APP_QUETRE=${APP_QUETRE:-""}
export APP_LIBREMDB=${APP_LIBREMDB:-""}
export APP_BREEZEWIKI=${APP_BREEZEWIKI:-""}
export APP_ANONYMOUS_OVERFLOW=${APP_ANONYMOUS_OVERFLOW:-""}

# GNU/Curl configurations. Leave 'CURLOPT_PROXY' blank whether you don't need to use a proxy for requests
# Generally, a proxy is needed when your IP address is blocked by search engines in response to multiple requests within a short time frame. In these cases, it is recommended to use rotating proxies
export CURLOPT_PROXY_ENABLED=${CURLOPT_PROXY_ENABLED:-false}
export CURLOPT_PROXY=${CURLOPT_PROXY:-""}
export CURLOPT_RETURNTRANSFER=${CURLOPT_RETURNTRANSFER:-true}
export CURLOPT_ENCODING=${CURLOPT_ENCODING:-""}
export CURLOPT_USERAGENT=${CURLOPT_USERAGENT:-"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36"}
export CURLOPT_CUSTOMREQUEST=${CURLOPT_CUSTOMREQUEST:-"GET"}
export CURLOPT_MAXREDIRS=${CURLOPT_MAXREDIRS:-5}
export CURLOPT_TIMEOUT=${CURLOPT_TIMEOUT:-18}
export CURLOPT_VERBOSE=${CURLOPT_VERBOSE:-false}

# These shell functions will be available for use by any function calls
function AwkTrim() { awk '{$1=$1};1'; }
