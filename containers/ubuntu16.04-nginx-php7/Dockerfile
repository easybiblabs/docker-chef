#Download base image ubuntu 16.04
FROM ubuntu:16.04

#Define the ENV variables
ENV webroot 		/webroot
ENV nginx_vhost 	/etc/nginx/sites-available/default
ENV php_conf		/etc/php/7.0/fpm/php.ini
ENV nginx_conf		/etc/nginx/nginx.conf
ENV supervisor_conf /etc/supervisor/supervisord.conf
ENV DEBIAN_FRONTEND noninteractive

# Update Software repository
RUN apt-get update
 
# Install nginx, php-fpm and supervisord from ubuntu repository
RUN apt-get install -y apt-utils nginx supervisor && \
	apt-get install -y \
    php7.0-fpm \
    php7.0-mbstring \
    php7.0-mcrypt  && \
	rm -rf /var/lib/apt/lists/*
 
 
# Copy the config file
COPY default ${nginx_vhost}

# Enable php-fpm on nginx virtualhost configuration
RUN sed -i -e 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g' ${php_conf}  && \
	sed -i -e 's/;error_log = php_errors.log/error_log = php_errors.log/g' ${php_conf}  && \
	printf "\ndaemon off;\n" >> ${nginx_conf}

# Copy supervisor configuration
COPY supervisord.conf ${supervisor_conf}

# set up PHP stuff
RUN mkdir -p ${webroot}
COPY webroot ${webroot}
RUN chown -R www-data:www-data ${webroot} && \
	chmod -R ug+rw ${webroot} && \
	mkdir -p /run/php && \
    chown -R www-data:www-data /run/php
 
# Volume configuration
VOLUME /etc/nginx/sites-enabled /etc/nginx/certs /etc/nginx/conf.d /var/log/nginx ${webroot}

ENV DEBIAN_FRONTEND teletype

# Configure Services and Port
COPY start.sh /start.sh
CMD ["./start.sh"]

EXPOSE 80 443
