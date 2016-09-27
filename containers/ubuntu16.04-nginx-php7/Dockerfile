#Download base image ubuntu 16.04
FROM ubuntu:16.04

#Define the ENV variables
ENV webroot			/webroot
ENV nginx_vhost		/etc/nginx/sites-available/default
ENV php_conf		/etc/php/7.0/fpm/php.ini
ENV php_conf_dir	/etc/php/7.0/fpm/
ENV nginx_conf		/etc/nginx/nginx.conf
ENV nginx_logs		/var/log/nginx/
ENV supervisor_conf	/etc/supervisor/supervisord.conf
ENV DEBIAN_FRONTEND	noninteractive

# Update Software repository
RUN apt-get update && \
# Install nginx, php-fpm and supervisord from ubuntu repository
	apt-get install -y apt-utils \
	nginx \
	supervisor \
    php7.0-fpm \
    php7.0-mbstring \
    php7.0-mcrypt  && \
	rm -rf /var/lib/apt/lists/*

# Enable php-fpm on nginx virtualhost configuration
RUN	sed -i -e 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g' ${php_conf} && \
	sed -i -e 's/;error_log = php_errors.log/error_log = \/proc\/self\/fd\/1/g' ${php_conf} && \
# start nginx in NOT daemon mode
	printf "\ndaemon off;\n" >> ${nginx_conf}

# mk the project and php dir
RUN	mkdir -p ${webroot} /run/php

# Copy the config file
COPY default ${nginx_vhost}

# Copy the config file
COPY php-fpm.conf ${php_conf_dir}

# Copy supervisor configuration
COPY supervisord.conf ${supervisor_conf}

# Copy the webroot
COPY webroot ${webroot}

# reset permissions properly
RUN chown -R www-data:www-data /run/php ${webroot} ${nginx_logs} && \
	chmod -R ug+rw ${webroot} ${nginx_logs}

ENV DEBIAN_FRONTEND teletype

# Volume configuration
VOLUME /etc/nginx/sites-enabled /etc/nginx/conf.d /var/log/nginx ${webroot}

# Copy the start script and Configure it to start
COPY start.sh /start.sh
CMD ["./start.sh"]

# Expose ports
EXPOSE 80 8080
