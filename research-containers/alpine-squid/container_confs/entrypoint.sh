#!/bin/sh
# ----------------------------------------------------------------------------
# entrypoint for squid container
# ----------------------------------------------------------------------------
set -e

SQUID_VERSION=$(/usr/sbin/squid -v | grep Version | awk '{ print $4 }')
if [ "$1" == "squid" ]; then

	echo "fixing permissions...."
	chown -R squid:squid /var/log/squid
	chown -R squid:squid /var/cache/squid

	echo "building squid cache directories...."
	/sbin/su-exec root /usr/sbin/squid -z &

	echo "starting squid [${SQUID_VERSION}]"
	/sbin/su-exec root /usr/sbin/squid &

	echo "Tailing logs..."
	tail -f /var/log/squid/*

else
	echo "Running something else"
	exec "$@"
fi

