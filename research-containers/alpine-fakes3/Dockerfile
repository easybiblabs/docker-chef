FROM alpine:3.4

# if edge libraries are needed use the following:
# RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories

# install base packages - BASH should only be used for debugging, it's almost a meg in size
# install ruby basic packages
# clean up the apk cache (no-cache still caches the indexes)
# Make the app directory
# install the fake s3 gem without docs
RUN	apk --update --no-cache add \
	--virtual .base_package bash ca-certificates \
	--virtual .basic_ruby ruby ruby-bundler && \
	rm -rf /var/cache/apk/* && \
	mkdir -p /var/data/fakes3 && \
	gem install fakes3 --no-ri --no-rdoc

# Add the files
COPY container_confs /

# fake s3 environment vars
ENV S3_USERNAME convox
ENV S3_PASSWORD password
ENV S3_PATH /bucket
ENV S3_PORT 4569
ENV FAKES3_URL

# LINK env vars for convox
ENV LINK_USERNAME convox
ENV LINK_PASSWORD password
ENV LINK_PATH /bucket
ENV LINK_PORT 4569

# expose the fake s3 port
EXPOSE 4569

# expose the app volume
VOLUME ["/var/data/fakes3"]

# the entry point definition
ENTRYPOINT ["/entrypoint.sh"]

# default command for entrypoint.sh
CMD ["fakes3"]
