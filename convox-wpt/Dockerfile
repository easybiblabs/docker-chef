FROM cheggwpt/ubuntu16.04-nginx-phpfpm7.0
COPY ./nginx_conf /etc/nginx/sites-enabled
COPY ./wpt /webroot
COPY .npmrc /webroot/.npmrc
COPY .npmrc /webroot/frontend/.npmrc
COPY .npmrc /webroot/backend/.npmrc
COPY build_config.php build_config.php
COPY build.sh build.sh
EXPOSE 8080 80
