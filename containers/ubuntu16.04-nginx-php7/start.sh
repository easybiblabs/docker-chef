#!/bin/sh
echo "Hello! V 0.12"
/usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf
echo "Goodbye"
