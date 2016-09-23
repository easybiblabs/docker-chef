#!/bin/sh
echo "Hello! V 0.11"
cat /etc/nginx/sites-availabe/default
find /webroot/
/usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf
echo "Goodbye"
