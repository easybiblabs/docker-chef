FROM alpine:edge

# install the packages && clean the cache && prep any directories
RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories && \
	apk --update --no-cache add bash ca-certificates su-exec squid && \
	rm -rf /var/cache/apk/* && \
	mkdir -p /var/cache/squid 

# Add the configuration files
COPY container_confs /

# set the bashrc stuff fer rut
COPY container_confs/etc/bashrc /root/.bashrc

EXPOSE 3128

# Set any environment variables
# ENV SQS_USERNAME convox
# ENV SQS_PASSWORD password
# ENV SQS_PATH /

# ENV LINK_USERNAME convox
# ENV LINK_PASSWORD password
# ENV LINK_PATH /

VOLUME		[ "/var/cache/squid" ]

RUN chmod a+x /entrypoint.sh

ENTRYPOINT [ "/entrypoint.sh" ]
CMD [ "squid" ]

# docker run -p 3128:3128 -dt squid squid
