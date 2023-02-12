#!/bin/sh

service php-fpm8 start
service nginx start

exec nginx -g daemon off;
