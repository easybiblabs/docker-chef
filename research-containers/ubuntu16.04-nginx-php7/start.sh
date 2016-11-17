#!/bin/sh
echo "Hello! V 0.14"
/usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf
echo "Goodbye"
