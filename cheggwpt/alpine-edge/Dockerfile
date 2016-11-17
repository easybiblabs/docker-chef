FROM alpine:edge
# FROM alpine:3.4

# if edge libraries are needed use the following:
RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories

# install base packages - BASH should only be used for debugging, it's almost a meg in size
# install ca-certificates
# clean up the apk cache (no-cache still caches the indexes)
# update the ca-certificates
RUN	apk --update --no-cache \
	add --virtual .base_packages bash ca-certificates && \
	rm -rf /var/cache/apk/* && \
	update-ca-certificates

# Add the files
COPY container_confs /

ENTRYPOINT ["/entrypoint.sh"]
CMD ["service"]
