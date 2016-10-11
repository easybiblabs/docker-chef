FROM ruby:2.1

RUN gem install fake_sqs

RUN mkdir -p /var/lib/sqs

EXPOSE 4568

ENV SQS_USERNAME convox
ENV SQS_PASSWORD password
ENV SQS_PATH /

ENV LINK_USERNAME convox
ENV LINK_PASSWORD password
ENV LINK_PATH /

ENTRYPOINT [ "/usr/local/bundle/bin/fake_sqs", "-p", "4568", "--no-daemonize" ]

