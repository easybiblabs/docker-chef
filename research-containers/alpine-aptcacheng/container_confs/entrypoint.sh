#!/bin/sh
# ----------------------------------------------------------------------------
# entrypoint for container
# ----------------------------------------------------------------------------
set -e

HOST_IP=`/bin/grep $HOSTNAME /etc/hosts | /usr/bin/cut -f1`
if [ "$1" == "fakesqs" ]; then
	echo "fixing permissions...."
	chmod 777 /var/cache/apt-cacher-ng 
	echo "Starting apt-cacher-ng..."
	/etc/init.d/apt-cacher-ng start 
	echo "Tailing Logs..."
	tail -f /var/log/apt-cacher-ng/*
else
	echo "Running something else"
	exec "$@"
fi
