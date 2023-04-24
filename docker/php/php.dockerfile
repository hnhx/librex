# Set this argument during build time to indicate that the path is for php's www.conf
ARG WWW_CONFIG="/etc/php7/php-fpm.d/www.conf"

# Configure 'opensearch.xml' with Librex configuration metadata, such as the encoding and the host that stores the site
# These configurations will replace the 'opensearch.xml' inside '.dockers/templates' for the best setup for your instance
ENV OPEN_SEARCH_TITLE="LibreX"
ENV OPEN_SEARCH_DESCRIPTION="Framework and javascript free privacy respecting meta search engine"
ENV OPEN_SEARCH_ENCODING="UTF-8"
ENV OPEN_SEARCH_LONG_NAME="LibreX search"
ENV OPEN_SEARCH_HOST="http://127.0.0.1:${NGINX_PORT}"

# Replace the 'config.php' script, which contains the most common search engine configurations, with these environment setups
# These environment setups can be found in 'config.php', and the default configurations can be useful for most use cases
ENV CONFIG_GOOGLE_DOMAIN="com"
ENV CONFIG_GOOGLE_LANGUAGE_SITE="en"
ENV CONFIG_GOOGLE_LANGUAGE_RESULTS="en"
ENV CONFIG_INVIDIOUS_INSTANCE="https://invidious.snopyta.org"
ENV CONFIG_HIDDEN_SERVICE_SEARCH=false
ENV CONFIG_DISABLE_BITTORRENT_SEARCH=false
ENV CONFIG_BITTORRENT_TRACKERS="&tr=http://nyaa.tracker.wf:7777/announce&tr=udp://open.stealth.si:80/announce&tr=udp://tracker.opentrackr.org:1337/announce&tr=udp://exodus.desync.com:6969/announce&tr=udp://tracker.torrent.eu.org:451/announce"

# Supported apps integration configuration. These empty spaces can be set up using free hosts as pointers
# A particular example is using the "https://yewtu.be" or a self-hosted host to integrate the invidious app to librex
ENV APP_INVIDIOUS=""
ENV APP_RIMGO=""
ENV APP_SCRIBE=""
ENV APP_LIBRARIAN=""
ENV APP_GOTHUB=""
ENV APP_NITTER=""
ENV APP_LIBREREDDIT=""
ENV APP_PROXITOK=""
ENV APP_WIKILESS=""
ENV APP_QUETRE=""
ENV APP_LIBREMDB=""
ENV APP_BREEZEWIKI=""
ENV APP_ANONYMOUS_OVERFLOW=""
ENV APP_SUDS=""
ENV APP_BIBLIOREADS=""


# GNU/Curl configurations. Leave 'CURLOPT_PROXY' blank whether you don't need to use a proxy for requests
# Generally, a proxy is needed when your IP address is blocked by search engines in response to multiple requests within a short time frame. In these cases, it is recommended to use rotating proxies
ENV CURLOPT_PROXY_ENABLED=false
ENV CURLOPT_PROXY=""
ENV CURLOPT_RETURNTRANSFER=true
ENV CURLOPT_ENCODING=""
ENV CURLOPT_USERAGENT="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36"
ENV CURLOPT_CUSTOMREQUEST="GET"
ENV CURLOPT_MAXREDIRS=5
ENV CURLOPT_TIMEOUT=18
ENV CURLOPT_VERBOSE=true

# Install PHP-FPM using Alpine's package manager, apk
# Configure PHP-FPM to listen on a Unix socket instead of a TCP port, which is more secure and efficient
RUN apk add php7 php7-fpm php7-dom php7-curl php7-json --no-cache --repository=http://dl-cdn.alpinelinux.org/alpine/edge/testing &&\
    sed -i 's/^\s*listen = 127.0.0.1:9000/listen = \/run\/php7\/php-fpm7.sock/' ${WWW_CONFIG} &&\
    sed -i 's/^\s*;\s*listen.owner = nobody/listen.owner = nginx/' ${WWW_CONFIG} &&\
    sed -i 's/^\s*;\s*listen.group = nobody/listen.group = nginx/' ${WWW_CONFIG} &&\
    sed -i 's/^\s*;\s*listen.mode = 0660/listen.mode = 0660/' ${WWW_CONFIG}
    
CMD [ "/bin/sh", "-c", "docker/php/prepare.sh" ]
