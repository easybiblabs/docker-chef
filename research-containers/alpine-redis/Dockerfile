FROM alpine:3.4

RUN	apk --update --no-cache add \
	--virtual .base_package bash ca-certificates \
	--virtual .redis_service redis && \
	rm -rf /var/cache/apk/* 

# Add the files
COPY container_confs /

# Environment
ENV LINK_SCHEME redis
ENV LINK_PASSWORD password
ENV LINK_PATH /0

RUN mkdir /data && chown nobody:nobody /data
VOLUME /data
WORKDIR /data

# Expose the ports for nginx
EXPOSE 6379

# define the entrypoint
ENTRYPOINT ["/entrypoint.sh"]
CMD ["redis"]
