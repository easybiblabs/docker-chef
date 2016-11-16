FROM cheggwpt/alpine-php7fpm

# if edge libraries are needed use the following:
RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories

# install base packages - BASH should only be used for debugging, it's almost a meg in size
# install ruby basic packages
# clean up the apk cache (no-cache still caches the indexes)
# Make the app directory
# install the fake sqs gem without docs
RUN	apk --update --no-cache add \
	--virtual .build_package build-base \
	--virtual .libreoffice libreoffice \
	nodejs && \
	rm -rf /var/cache/apk/* 
