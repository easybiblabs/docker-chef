#!/bin/sh
echo "Hello! V 0.2"
/usr/bin/supervisord -n -c /etc/supervisord.conf
echo "Goodbye"
