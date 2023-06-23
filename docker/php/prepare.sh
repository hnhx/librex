#!/bin/sh

echo "[PREPARE] docker/server/prepare.sh'"

# Load all environment variables from 'attributes.sh' using the command 'source /path/attributes.sh'
source "docker/attributes.sh"

# This condition creates the Unix socket if 'php-fpm8.sock' does not already exist.
# This fixes an issue where Nginx starts but does not serve content
if [ ! -d "/run/php8" ] || [ ! -S "/run/php8/php-fpm8.sock" ]; then
    mkdir "/run/php8"
    touch "/run/php8/php-fpm8.sock"
    chmod 660 "/run/php8/php-fpm8.sock"
    chown nginx:nginx "/run/php8/php-fpm8.sock"
fi

# The lines below will replace the environment variables in the templates with the corresponding variables listed above. To accomplish this, the GNU 'envsubst' package will be used
# Although not recommended (if you do not know what you are doing), you still have the option to add new substitution file templates using any required environment variables
[[ ! -s ${CONFIG_PHP_TEMPLATE} ]] && cat 'docker/php/config.php' | envsubst > ${CONFIG_PHP_TEMPLATE};
[[ ! -s ${CONFIG_OPEN_SEARCH_TEMPLATE} ]] && cat 'docker/php/opensearch.xml' | envsubst > ${CONFIG_OPEN_SEARCH_TEMPLATE};

# If it is empty or proxy is not enabled, we are using sed to delete
# any line that contains the string 'CURLOPT_PROXY' or 'CURLOPT_PROXYTYPE'
# from the file 'config.php' defined on top of 'attributes.sh'
if [[ -z "${CURLOPT_PROXY}" || "${CURLOPT_PROXY_ENABLED}" = false ]]; then
    sed -i "/CURLOPT_PROXY/d" ${CONFIG_PHP_TEMPLATE};
    sed -i "/CURLOPT_PROXYTYPE/d" ${CONFIG_PHP_TEMPLATE};
fi
