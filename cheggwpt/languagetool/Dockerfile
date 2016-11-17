FROM cheggwpt/java:latest

# BASICS - java 
RUN	apk --update --no-cache add \
	--virtual .base_package wget supervisor && \
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
CMD ["supervisor"]
