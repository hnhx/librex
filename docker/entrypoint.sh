#!/bin/sh

# Due to an issue with Docker's 'CMD' directive, the following scripts are not executing as expected.
# This workaround has been implemented to resolve the issue for now
sh "docker/php/prepare.sh"
sh "docker/server/prepare.sh"

service php-fpm7 start
service nginx start

exec nginx -g "daemon off;"
