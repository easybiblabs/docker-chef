#!/bin/sh
# ----------------------------------------------------------------------------
# entrypoint for container
# ----------------------------------------------------------------------------
set -e

if [ "$1" == "nginx" ]; then
	echo "starting services...."
	/usr/bin/supervisord -n -c /etc/supervisord.conf
else
	echo "Running something else"
	exec "$@"
fi
