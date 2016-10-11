FROM ruby:2.1.4

RUN gem install fakes3

RUN mkdir -p /var/data/fake-s3

EXPOSE 4569

ENV S3_USERNAME convox
ENV S3_PASSWORD password
ENV S3_PATH /bucket

ENV LINK_USERNAME convox
ENV LINK_PASSWORD password
ENV LINK_PATH /bucket

ENTRYPOINT [ "/usr/local/bundle/bin/fakes3", "-r" ,"/var/data/fake-s3", "-p", "4569" ]
