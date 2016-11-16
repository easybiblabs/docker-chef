FROM cheggwpt/alpine-edge:latest

# install ruby basic packages
# clean up the apk cache (no-cache still caches the indexes)
# Make the app directory
# install the fake sqs gem without docs
RUN	apk --update --no-cache add \
		--virtual .nginx_service nginx supervisor && \
		rm -rf /var/cache/apk/* 

# Add the files
COPY container_confs /

# Add the www-data user and group, fail on error
RUN set -x ; \
	addgroup -g 82 -S www-data ; \
	adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1 

# Add the process control dirs for nginx and supervisord.  webroot is added by copy container confs
# own up the nginx control dir
# own up the webroot dir
# make it user/group read write
RUN mkdir -p /run/nginx /run/supervisord /webroot && \
	chown -R nginx:www-data /run/nginx && \
	chown -R www-data:www-data /webroot && \
	chmod -R ug+rw /webroot

# Expose the ports for nginx
EXPOSE 80 443

# expose the app volume
VOLUME ["/webroot"]

# the entry point definition
ENTRYPOINT ["/entrypoint.sh"]

# default command for entrypoint.sh
CMD ["supervisord"]
