#!/bin/sh

echo "[PREPARE] docker/server/prepare.sh'"

# Load all environment variables from 'attributes.sh' using the command 'source /path/attributes.sh'
source "docker/attributes.sh"

export OPEN_SEARCH_HOST_FOR_NGINX="$(echo "${OPEN_SEARCH_HOST}" | cut -d "/" -f 3 | cut -d ":" -f 1)"

# The lines below will replace the environment variables in the templates with the corresponding variables listed above. To accomplish this, the GNU 'envsubst' package will be used
# Although not recommended (if you do not know what you are doing), you still have the option to add new substitution file templates using any required environment variables
if [[ ! -s ${CONFIG_NGINX_TEMPLATE} ]]; then
    cp "docker/server/fastcgi.conf" /etc/nginx/fastcgi.conf
    cp "docker/server/nginx.conf" /etc/nginx/http.d/librex.conf

    # To address issues with 'nginx.conf', the following lines will ensure that these configurations remain executable
    chmod u+x "/etc/nginx/fastcgi.conf"
    chmod u+x "/etc/nginx/http.d/librex.conf"

    cat 'docker/server/nginx.conf' | envsubst '${OPEN_SEARCH_HOST_FOR_NGINX}' > ${CONFIG_NGINX_TEMPLATE};
fi
