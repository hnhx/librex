#!/bin/sh

# YOU DON'T NEED TO EDIT THIS FILE. IF YOU WANT TO SET CUSTOM ENVIRONMENT VARIABLES,
# USE THE 'DOCKERFILE IMAGE' FROM ROOT DIRECTORY AND PASS THE ENVIRONMENT PARAMETERS

# This variable changes the behavior of the image builder to remove the base image
export DOCKER_BUILDKIT=1

# These templates will be used to create configuration files that incorporate values from environment variables
# If these locations do not already exist within the Docker container, they will be created
export CONFIG_PHP_TEMPLATE="$(pwd)/templates/config.php"
export CONFIG_NGINX_TEMPLATE="$(pwd)/templates/nginx.conf"
export CONFIG_OPEN_SEARCH_TEMPLATE="$(pwd)/templates/opensearch.xml"

# Configure 'opensearch.xml' with Librex configuration metadata, such as the encoding and the host that stores the site
# These configurations will replace the 'opensearch.xml' inside '.dockers/templates' for the best setup for your instance
export OPEN_SEARCH_TITLE="${OPEN_SEARCH_TITLE:-'LibreX'}"
export OPEN_SEARCH_DESCRIPTION="${OPEN_SEARCH_DESCRIPTION:-'Framework and javascript free privacy respecting meta search engine'}"
export OPEN_SEARCH_ENCODING="${OPEN_SEARCH_ENCODING:-'UTF-8'}"
export OPEN_SEARCH_LONG_NAME="${OPEN_SEARCH_LONG_NAME:-'LibreX Search'}"
export OPEN_SEARCH_HOST="${OPEN_SEARCH_HOST:-'http://localhost:80'}"

# Replace the 'config.php' script, which contains the most common search engine configurations, with these environment setups
# These environment setups can be found in 'config.php', and the default configurations can be useful for most use cases
export CONFIG_GOOGLE_DOMAIN="${CONFIG_GOOGLE_DOMAIN:-'.com'}"
export CONFIG_GOOGLE_LANGUAGUE="${CONFIG_GOOGLE_LANGUAGUE:-'en'}"
export CONFIG_INVIDIOUS_INSTANCE="${CONFIG_INVIDIOUS_INSTANCE:-'invidious.namazso.eu'}"
export CONFIG_HIDDEN_SERVICE_SEARCH=${CONFIG_HIDDEN_SERVICE_SEARCH:-false}
export CONFIG_DISABLE_BITTORRENT_SEARCH=${CONFIG_DISABLE_BITTORRENT_SEARCH:-false}
export CONFIG_BITTORRENT_TRACKERS="${CONFIG_BITTORRENT_TRACKERS:-'&tr=http://nyaa.tracker.wf:7777/announce&tr=udp://open.stealth.si:80/announce&tr=udp://tracker.opentrackr.org:1337/announce&tr=udp://exodus.desync.com:6969/announce&tr=udp://tracker.torrent.eu.org:451/announce'}"

# Supported apps integration configuration. These empty spaces can be set up using free hosts as pointers
# A particular example is using the "https://yewtu.be" or a self-hosted host to integrate the invidious app to librex
export APP_INVIDIOUS="${APP_INVIDIOUS:-''}"
export APP_BIBLIOGRAM="${APP_BIBLIOGRAM:-''}"
export APP_RIMGO="${APP_RIMGO:-''}"
export APP_SCRIBE="${APP_SCRIBE:-''}"
export APP_LIBRARIAN="${APP_LIBRARIAN:-''}"
export APP_GOTHUB="${APP_GOTHUB:-''}"
export APP_NITTER="${APP_NITTER:-''}"
export APP_LIBREREDDIT="${APP_LIBREREDDIT:-''}"
export APP_PROXITOK="${APP_PROXITOK:-''}"
export APP_WIKILESS="${APP_WIKILESS:-''}"
export APP_QUETRE="${APP_QUETRE:-''}"
export APP_LIBREMDB="${APP_LIBREMDB:-''}"
export APP_BREEZEWIKI="${APP_BREEZEWIKI:-''}"
export APP_ANONYMOUS_OVERFLOW="${APP_ANONYMOUS_OVERFLOW:-''}"

# GNU/Curl configurations. Leave 'CURLOPT_PROXY' blank whether you don't need to use a proxy for requests
# Generally, a proxy is needed when your IP address is blocked by search engines in response to multiple requests within a short time frame. In these cases, it is recommended to use rotating proxies
export CURLOPT_PROXY_ENABLED=${CURLOPT_PROXY_ENABLED:-false}
export CURLOPT_PROXY="${CURLOPT_PROXY:-''}"
export CURLOPT_RETURNTRANSFER=${CURLOPT_RETURNTRANSFER:-true}
export CURLOPT_ENCODING="${CURLOPT_ENCODING:-''}"
export CURLOPT_USERAGENT="${CURLOPT_USERAGENT:-'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36'}"
export CURLOPT_CUSTOMREQUEST="${CURLOPT_CUSTOMREQUEST:-'GET'}"
export CURLOPT_MAXREDIRS=${CURLOPT_MAXREDIRS:-5}
export CURLOPT_TIMEOUT=${CURLOPT_TIMEOUT:-18}
export CURLOPT_VERBOSE=${CURLOPT_VERBOSE:-false}

# The lines below will replace the environment variables in the templates with the corresponding variables listed above. To accomplish this, the GNU 'envsubst' package will be used
# Although not recommended (if you do not know what you are doing), you still have the option to add new substitution file templates using any required environment variables
[[ ! -s ${CONFIG_PHP_TEMPLATE} ]] && cat '$(pwd)/config.php' | envsubst | AwkTrim > ${CONFIG_PHP_TEMPLATE}
[[ ! -s ${CONFIG_NGINX_TEMPLATE} ]] && cat '$(pwd)/nginx.conf' | envsubst | AwkTrim > ${CONFIG_NGINX_TEMPLATE}
[[ ! -s ${CONFIG_OPEN_SEARCH_TEMPLATE} ]] && cat '$(pwd)/opensearch.xml' | envsubst | AwkTrim > ${CONFIG_OPEN_SEARCH_TEMPLATE}

# These shell functions will be available for use by any function calls
function AwkTrim() { awk '{$1=$1};1' }
