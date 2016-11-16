FROM alpine:3.4

# if edge libraries are needed use the following:
# RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories && \


# install base packages - BASH should only be used for debugging, it's almost a meg in size
# install ruby basic packages
# clean up the apk cache (no-cache still caches the indexes)
# Make the app directory
# install the fake sqs gem without docs

RUN	apk --update --no-cache add \
	--virtual .base_package bash ca-certificates \
	--virtual .basic_node nodejs && \
	rm -rf /var/cache/apk/* && \
	mkdir -p /var/data/sqs && \
	npm install sinopia

# Add the files
COPY container_confs /

# Expose the ports for nginx
EXPOSE 80 443

ENTRYPOINT ["/entrypoint.sh"]
CMD ["nginx"]
