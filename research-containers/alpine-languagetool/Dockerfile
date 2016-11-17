FROM alpine:3.4

# Default to UTF-8 file.encoding
ENV LANG C.UTF-8

# add a simple script that can auto-detect the appropriate JAVA_HOME value
# based on whether the JDK or only the JRE is installed
RUN { \
		echo '#!/bin/sh'; \
		echo 'set -e'; \
		echo; \
		echo 'dirname "$(dirname "$(readlink -f "$(which javac || which java)")")"'; \
	} > /usr/local/bin/docker-java-home \
	&& chmod +x /usr/local/bin/docker-java-home

ENV JAVA_HOME /usr/lib/jvm/java-1.8-openjdk
ENV PATH $PATH:/usr/lib/jvm/java-1.8-openjdk/jre/bin:/usr/lib/jvm/java-1.8-openjdk/bin
ENV JAVA_VERSION 8u92
ENV JAVA_ALPINE_VERSION 8.92.14-r1

# BASICS - java 
RUN	apk --update --no-cache add \
	--virtual .base_package bash ca-certificates wget supervisor \
	--virtual .java_package openjdk8="$JAVA_ALPINE_VERSION" && \
	["$JAVA_HOME"="$(docker-java-home)"] && \
	update-ca-certificates && \
	rm -rf /var/cache/apk/* && \
	mkdir -p /run/supervisord

# LANGUAGE TOOLS
ENV LANGUAGETOOL_VERSION 3.4
RUN wget -q https://languagetool.org/download/LanguageTool-$LANGUAGETOOL_VERSION.zip -P /tmp && \
	unzip /tmp/LanguageTool-$LANGUAGETOOL_VERSION.zip -d /usr/local && \
	ln -s /usr/local/LanguageTool-$LANGUAGETOOL_VERSION /usr/local/languagetool && \
	rm /tmp/LanguageTool-$LANGUAGETOOL_VERSION.zip

EXPOSE 8081

# Add the files
COPY container_confs /

ENTRYPOINT ["/entrypoint.sh"]
CMD ["supervisord"]
