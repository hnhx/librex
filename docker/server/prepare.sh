#!/bin/sh

# Load all environment variables from 'attributes.sh' using the command 'source /path/attributes.sh'
source "docker/attributes.sh"

# The lines below will replace the environment variables in the templates with the corresponding variables listed above. To accomplish this, the GNU 'envsubst' package will be used
# Although not recommended (if you do not know what you are doing), you still have the option to add new substitution file templates using any required environment variables
exec cat 'docker/server/nginx.conf' | envsubst > ${CONFIG_NGINX_TEMPLATE};
