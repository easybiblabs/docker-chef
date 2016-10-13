FROM alpine:edge

RUN apk add --no-cache bash ruby ruby-bundler ca-certificates
RUN gem install fake_sqs --no-ri --no-rdoc
RUN mkdir -p /var/data/sqs

EXPOSE 4568

ENV SQS_USERNAME convox
ENV SQS_PASSWORD password
ENV SQS_PATH /

ENV LINK_USERNAME convox
ENV LINK_PASSWORD password
ENV LINK_PATH /

ENTRYPOINT [ "/usr/bin/fake_sqs", "-v", "--database", "/var/data/sqs/queues", "-p", "4568", "--no-daemonize" ]

# /usr/bin/fake_sqs -v -p 4568 --database /var/data/sqs/queues --no-daemonize
