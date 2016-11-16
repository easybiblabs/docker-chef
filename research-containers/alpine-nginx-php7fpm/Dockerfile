FROM alpine:edge

RUN	echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories && \
	apk --update --no-cache add ca-certificates \
		nginx \
		supervisor \
		nodejs \
		mysql-client \
		php7 \
		php7-bcmath \
		php7-bz2 \
		php7-ctype \
		php7-curl \
		php7-dom \
		php7-fpm \
		php7-gd \
		php7-gettext \
		php7-gmp \
		php7-iconv \
		php7-json \
		php7-mbstring \
		php7-mcrypt \
		php7-mysqli \
		php7-openssl \
		php7-pdo \
		php7-pdo_dblib \
		php7-pdo_mysql \
		php7-pdo_pgsql \
		php7-pdo_sqlite \
		php7-phar \
		php7-soap \
		php7-sqlite3 \
		php7-xmlreader \
		php7-xmlrpc \
		php7-zip \
		bash curl make wget git && \
		rm -rf /var/cache/apk/* 
		
# Add the files
COPY container_confs /

COPY container_confs/etc/bashrc /root/.bashrc

RUN set -x ; \
	addgroup -g 82 -S www-data ; \
	adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1 

# Enable php-fpm on nginx virtualhost configuration
RUN	sed -i -e 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g' /etc/php7/php.ini && \
	sed -i -e 's/display_errors = Off/display_errors = On/g' /etc/php7/php.ini && \
	sed -i -e 's/;error_log = php_errors.log/error_log = \/proc\/self\/fd\/1/g' /etc/php7/php.ini

RUN ln -s /usr/bin/php7 /usr/bin/php && \
	mkdir -p /run/php /run/nginx /run/supervisord && \
	chown -R nginx:www-data /run/nginx && \
	chown -R www-data:www-data /run/php /webroot && \
	chmod -R ug+rw /webroot

# Expose the ports for nginx
EXPOSE 80 443

# Define the entry point
ENTRYPOINT ["/entrypoint.sh"]
CMD ["nginx"]
