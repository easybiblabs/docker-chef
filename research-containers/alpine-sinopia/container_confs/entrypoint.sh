#!/bin/sh
# ----------------------------------------------------------------------------
# entrypoint for container
# ----------------------------------------------------------------------------
set -e
HOST_IP=`/bin/grep $HOSTNAME /etc/hosts | /usr/bin/cut -f1`
if [ "$1" == "sinopia" ]; then
	echo "starting sinopia with...."
	echo /usr/bin/fake_sqs -v -o $HOST_IP -p 4568 --database /var/data/sqs/queues --log /proc/self/fd/1 --no-daemonize
	/usr/bin/fake_sqs -v -o $HOST_IP -p 4568 --database /var/data/sqs/queues --log /proc/self/fd/1 --no-daemonize
elif [ "$1" == "bash" ] || [ "$1" == "shell" ]; then
	echo "starting /bin/bash...."
	/bin/bash --rcfile /etc/bashrc
else
	echo "Running something else"
	exec "$@"
fi
