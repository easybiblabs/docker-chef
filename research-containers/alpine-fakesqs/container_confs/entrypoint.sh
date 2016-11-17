#!/bin/sh
# ----------------------------------------------------------------------------
# entrypoint for container
# ----------------------------------------------------------------------------
set -e
HOST_IP=`/bin/grep $HOSTNAME /etc/hosts | /usr/bin/cut -f1`
echo "started with ip: ${HOST_IP}..."

if [ "$1" == "fakesqs" ]; then
	echo "starting fakesqs with...."
	echo /usr/bin/fake_sqs -v -o $HOST_IP -p 4568 --database /var/data/sqs/queues --log /proc/self/fd/1 --no-daemonize
	/usr/bin/fake_sqs -v -o $HOST_IP -p 4568 --database /var/data/sqs/queues --log /proc/self/fd/1 --no-daemonize
elif [ "$1" == "bash" ] || [ "$1" == "shell" ]; then
	echo "starting /bin/bash...."
	/bin/bash --rcfile /etc/bashrc
else
	echo "Running something else"
	exec "$@"
fi
