FROM alpine:edge

RUN	echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories && \
	apk --update --no-cache add \
		nginx \
		supervisor \
		nodejs \
		mysql-client \
		php7 \
		php7-fpm \
		php7-phar \
		php7-mcrypt \
		php7-soap \
		php7-openssl \
		php7-gmp \
		php7-pdo_odbc \
		php7-json \
		php7-dom \
		php7-pdo \
		php7-zip \
		php7-mysqli \
		php7-sqlite3 \
		php7-pdo_pgsql \
		php7-bcmath \
		php7-gd \
		php7-odbc \
		php7-pdo_mysql \
		php7-pdo_sqlite \
		php7-gettext \
		php7-xmlreader \
		php7-xmlrpc \
		php7-bz2 \
		php7-iconv \
		php7-pdo_dblib \
		php7-curl \
		php7-ctype \
		php7-mbstring \
		bash curl make wget git && \
		rm -rf /var/cache/apk/* 
		
# Add the files
ADD container_confs /

ADD container_confs/etc/bashrc /root/.bashrc

RUN set -x ; \
	addgroup -g 82 -S www-data ; \
	adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1 

RUN ln -s /usr/bin/php7 /usr/bin/php && \
	mkdir -p /run/php /run/nginx && \
	chown -R nginx:www-data /run/nginx && \
	chown -R www-data:www-data /run/php /webroot && \
	chmod -R ug+rw /webroot

# Expose the ports for nginx
EXPOSE 80 443 9000

ENTRYPOINT ["/start.sh"]
