#
# Build: docker build -t apt-cacher .
# Run: docker run -d -p 3142:3142 --name apt-cacher-run apt-cacher
#
# and then you can run containers with:
#   docker run -t -i --rm -e http_proxy http://dockerhost:3142/ debian bash
#
# Here, `dockerhost` is the IP address or FQDN of a host running the Docker daemon
# which acts as an APT proxy server.

FROM		alpine:edge

VOLUME		['/var/cache/apt-cacher-ng']
# RUN 		apt-get update && apt-get install -y apt-cacher-ng
COPY		container_confs /
EXPOSE      3142

# Define the entry point
ENTRYPOINT	["/entrypoint.sh"]
CMD 		[ "aptcache" ]