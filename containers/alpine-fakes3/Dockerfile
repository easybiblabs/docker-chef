FROM alpine:edge

RUN apk add --no-cache bash ruby ruby-bundler ca-certificates 
RUN gem install fakes3 --no-ri --no-rdoc
RUN mkdir -p /var/data/fakes3

EXPOSE 4569

ENV S3_USERNAME convox
ENV S3_PASSWORD password
ENV S3_PATH /bucket

ENV LINK_USERNAME convox
ENV LINK_PASSWORD password
ENV LINK_PATH /bucket

ENTRYPOINT [ "/usr/bin/fakes3", "-r" ,"/var/data/fakes3", "-p", "4569" ]

# /usr/bin/fakes3 -p 4569 -r /var/lib/fakes3
