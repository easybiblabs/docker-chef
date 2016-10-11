#!/bin/sh

echo 'building configurations...'
php build_config.php

echo " starting supervisord ... "
/usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf
echo "Goodbye"
