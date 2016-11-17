#!/bin/sh
# ----------------------------------------------------------------------------
# entrypoint for container
# ----------------------------------------------------------------------------
set -e
HOST_IP=`/bin/grep $HOSTNAME /etc/hosts | /usr/bin/cut -f1`
echo "started with ip: ${HOST_IP}..."

if [ "$1" == "fakes3" ]; then
	echo "starting fakes3 with...."
	echo /usr/bin/fakes3 -p 4569 -r /var/data/fakes3
	/usr/bin/fakes3 -p 4569 -r /var/data/fakes3
elif [ "$1" == "bash" ] || [ "$1" == "shell" ]; then
	echo "starting /bin/bash...."
	/bin/bash --rcfile /etc/bashrc
else
	echo "Running something else"
	exec "$@"
fi
