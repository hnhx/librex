#!/bin/sh

# Due to an issue with Docker's 'CMD' directive, the following scripts are not executing as expected.
# This workaround has been implemented to resolve the issue for now
sh "docker/php/prepare.sh"
sh "docker/server/prepare.sh"

/bin/sh -c /usr/sbin/php-fpm7

touch /var/log/php7/error.log /var/log/nginx/access.log /var/log/nginx/error.log
tail -f /var/log/php7/error.log /var/log/nginx/access.log /var/log/nginx/error.log &
exec nginx -g "daemon off;"
