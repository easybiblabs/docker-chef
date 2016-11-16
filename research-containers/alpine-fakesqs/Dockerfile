FROM alpine:3.4

# if edge libraries are needed use the following:
# RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories

# install base packages - BASH should only be used for debugging, it's almost a meg in size
# install ruby basic packages
# clean up the apk cache (no-cache still caches the indexes)
# Make the app directory
# install the fake sqs gem without docs
RUN	apk --update --no-cache add \
	--virtual .base_package bash ca-certificates \
	--virtual .basic_ruby ruby ruby-bundler && \
	rm -rf /var/cache/apk/* && \
	mkdir -p /var/data/sqs && \
	gem install fake_sqs -v 0.3.1 --no-ri --no-rdoc

# Add the files
# this container has a "patch" for fake_sqs 0.3.1 that flushes the cache for each "msg" for stdio logging
COPY container_confs /

# fake SQS environment vars
ENV SQS_USERNAME convox
ENV SQS_PASSWORD password
ENV SQS_PATH /

# LINK env vars for convox
ENV LINK_USERNAME convox
ENV LINK_PASSWORD password
ENV LINK_PATH /

# expose the fake sqs port
EXPOSE 4568

# expose the app volume
VOLUME ["/var/data/sqs/"]

# the entry point definition
ENTRYPOINT ["/entrypoint.sh"]

# default command for entrypoint.sh
CMD ["fakesqs"]
