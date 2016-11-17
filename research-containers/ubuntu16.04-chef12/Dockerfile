FROM ubuntu:16.04
RUN apt-get -yqq update
RUN apt-get -yqq install curl lsb-release
RUN curl -L https://www.chef.io/chef/install.sh | sudo bash -s -- -v 12.1.1-1
RUN apt-get -yqq clean
COPY ./zero.rb /etc/chef/client.rb
VOLUME ["/opt/chef", "/etc/chef"]
