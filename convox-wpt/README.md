**Build stack**

First build the ubuntu16.04-nginx-php7.0fpm container.

```
cd containers/ubuntu16.04-nginx-php7
docker rmi php:7.0
docker build -t php:7.0 .
```

check out wpt into a subdirectory of this directory named wpt

```
CONVOX_DEBUG=1 convox start
```


backend is available at http://localhost:8080/

logs are available in data_logs



