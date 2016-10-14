FROM alpine:edge

RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories && \
	apk --update --no-cache add bash ruby ruby-bundler ca-certificates && \
	rm -rf /var/cache/apk/* && \
	mkdir -p /var/data/sqs && \
	gem install fake_sqs --no-ri --no-rdoc

# Add the files
ADD container_confs /

EXPOSE 4568

ENV SQS_USERNAME convox
ENV SQS_PASSWORD password
ENV SQS_PATH /

ENV LINK_USERNAME convox
ENV LINK_PASSWORD password
ENV LINK_PATH /

ENTRYPOINT ["/start.sh"]

# /usr/bin/fake_sqs -v -p 4568 --database /var/data/sqs/queues --log /proc/self/fd/1 --no-daemonize

