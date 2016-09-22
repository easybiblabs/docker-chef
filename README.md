**Helpful Docker Snippits**

* `docker ps -a` Show the containers
* `docker images -q` show the images
* `docker rm $(docker ps -a -q)` delete all containers
* `docker rmi $(docker images -q)` delete all images without the force
* `docker rmi -f $(docker images -q)` delete all images **USE THE FORCE**


**Make ubuntu16.04-nginx-php7.0-fpm Image**

```
cd container-ubuntu16.04-nginx-php7
docker build -t php:7.0 .
```

**run convox wpt rack locally**
edit convox-wpt/Docker.rb and change the paths to your setup
make wpt convox 
```
cd convox-wpt
convox start
```


