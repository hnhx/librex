
### [Introduction](https://github.com/juniorbotelho/librex/tree/docker/docker#introduction)

- [Running a docker container](https://github.com/juniorbotelho/librex/tree/docker/docker#running-a-docker-container)
  - [Run a docker container from Docker Hub with `librex/librex:latest`](https://github.com/juniorbotelho/librex/tree/docker/docker#running-a-docker-container-from-docker-hub-with-)
  - Run a docker container using the `docker-compose.yml` file
  - Environments can be configured in docker container
- Docker version issues
- Building a docker image
- Support differents architectures


### Running a docker container

Dockerized Librex is a way to provide users with yet another way to self-host their own projects with a view to privacy. If you wish to help, please start by looking for bugs in used docker configurations.

### Run a docker container from Docker Hub with `librex/librex:latest`

To run librex in a docker container, you can simply use the command:

```sh
docker run -d --name librex \
    -e TZ="America/New_York" \
    -e CONFIG_GOOGLE_DOMAIN="com" \
    -e CONFIG_GOOGLE_LANGUAGUE="en" \
    -p 8080:8080 \
    librex/librex:latest
```

or with **`docker-compose.yml`**:

```yml
version: "2.1"
services:
  librex:
    image: librex/librex:latest
    container_name: librex
    network_mode: bridge
    ports:
      - 8080:8080
    environment:
      - PUID=1000
      - PGID=1000
      - VERSION=docker
      - TZ="America/New_York"
      - CONFIG_GOOGLE_DOMAIN="com"
      - CONFIG_GOOGLE_LANGUAGUE="en"
    volumes:
      - ./nginx_logs:/var/log/nginx
      - ./php_logs:/var/log/php7
    restart: unless-stopped
```


### Docker Version

If you are going to build your own docker image based on this repository, pay attention to your Docker version, because depending on how recent the installed version is, maybe you should use the `buildx` command instead of `build`.

Docker <= 20.10: `docker build`

Docker > 20.10: `docker buildx build`


### Build

If you don't want to use the image that is already available on `docker hub`, then you can simply build the Dockerfile directly from the github repository using the command:

```sh
docker build https://github.com/hnhx/librex.git -t librex:latest
```

```sh
docker run -d --name librex \
    -e CONFIG_GOOGLE_DOMAIN="com" \
    -e CONFIG_GOOGLE_LANGUAGUE="en" \
    -p 8080:8080 \
    librex:latest
```

Or, instead of doing the build remotely, you still have the opportunity to `git clone` the repository, and build it locally with the command:

```sh
git clone https://github.com/hnhx/librex.git
cd librex/
docker build -t librex:latest .
```


### Supported Architectures

Supported architectures for the official Librex images include the same ones supported by Alpine itself, which are typically denoted as `linux/386`, `linux/amd64`, `linux/arm/v6`. If you need support for a different architecture, such as `linux/arm/v7`, you can modify the 'Dockerfile' to use a more comprehensive base image like `ubuntu:latest` instead.

In this case, you must run the `build` process specifying the desired architecture as shown in the example below:

```sh
docker buildx build \
    --no-cache \
    --platform linux/arm/v7 \
    --tag librex/librex:latest .
```

**OBS:** Keep in mind that this can cause some issues at build time, so you need to know a little about Dockerfiles to solve this problem for your specific case.
