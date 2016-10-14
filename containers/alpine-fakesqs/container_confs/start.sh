#!/bin/sh
echo "Hello!"

set -e

HOST_IP=`/bin/grep $HOSTNAME /etc/hosts | /usr/bin/cut -f1`

echo /usr/bin/fake_sqs -v -o $HOST_IP -p 4568 --database /var/data/sqs/queues --log /proc/self/fd/1 --no-daemonize
/usr/bin/fake_sqs -v -o $HOST_IP -p 4568 --database /var/data/sqs/queues --log /proc/self/fd/1 --no-daemonize

echo "Goodbye"
