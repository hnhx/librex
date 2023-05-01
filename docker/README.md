
### Introduction

- [Introduction](#introduction)
  - [Running a docker container](#running-a-docker-container)
  - [Running a Docker container through the Docker hub](#running-a-docker-container-through-the-docker-hub)
  - [Running a Docker container with composer](#running-a-docker-container-with-composer)
  - [Environment variables that can be set in the Docker container](#environment-variables-that-can-be-set-in-the-docker-container)
    - [OpenSearch](#opensearch)
    - [Search Config](#search-config)
    - [Wikipedia](#wikipedia)
    - [Applications](#applications)
    - [Curl](#curl)
- [Docker version issues](#docker-version-issues)
- [Building a docker image](#building-a-docker-image)
- [Support for different architectures](#support-for-different-architectures)

### Running a docker container

Dockerized Librex is a way to provide users with yet another way to self-host their own projects with a view to privacy. If you wish to help, please start by looking for bugs in used docker configurations.

### Running a Docker container through the Docker hub

To run librex in a docker container, you can simply use the command:

```sh
docker run -d \
  --name librex \
  -e TZ="America/New_York" \
  -e CONFIG_GOOGLE_DOMAIN="com" \
  -e CONFIG_GOOGLE_LANGUAGE="en" \
  -e CONFIG_WIKIPEDIA_LANGUAGE="en" \
  -p 8080:8080 \
  librex/librex:latest
```

<br>

### Running a Docker container with composer

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
      - CONFIG_GOOGLE_LANGUAGE="en"
      - CONFIG_WIKIPEDIA_LANGUAGE="en"
    volumes:
      - ./nginx_logs:/var/log/nginx
      - ./php_logs:/var/log/php7
    restart: unless-stopped
```

<br>

### Environment variables that can be set in the Docker container

This docker image was developed with high configurability in mind, so here is the list of environment variables that can be changed according to your use case, no matter how specific.

<br>

### OpenSearch

| Variables | Default | Examples | Description |
|:----------|:-------------|:---------|:------|
| OPEN_SEARCH_TITLE |  "LibreX" | string | [OpenSearch XML](https://developer.mozilla.org/en-US/docs/Web/OpenSearch) |
| OPEN_SEARCH_DESCRIPTION | "Framework and javascript free privacy respecting meta search engine" | string | [OpenSearch XML](https://developer.mozilla.org/en-US/docs/Web/OpenSearch) |
| OPEN_SEARCH_ENCODING | "UTF-8" | "UTF-8" | [OpenSearch XML](https://developer.mozilla.org/en-US/docs/Web/OpenSearch) |
| OPEN_SEARCH_LONG_NAME | "Librex Search" | string | [OpenSearch XML](https://developer.mozilla.org/en-US/docs/Web/OpenSearch) |
| OPEN_SEARCH_HOST | "http://localhost:8080" | string | Host used to identify Librex on the network |

<br>

### Search Config

| Variables | Default | Examples | Description |
|:----------|:-------------|:---------|:------|
| CONFIG_GOOGLE_DOMAIN |  "com" | "com", "com.br", "com.es" | Defines which Google domain the search will be done, change according to your country |
| CONFIG_GOOGLE_LANGUAGE | "en" | "pt", "es", "ru" | Defines the language in which searches will be done, see the list of supported languages [here](https://developers.google.com/custom-search/docs/ref_languages). |
| CONFIG_INVIDIOUS_INSTANCE | "https://invidious.namazso.eu" | string | Defines the host that will be used to do video searches using invidious |
| CONFIG_HIDDEN_SERVICE_SEARCH | false | boolean | Defines whether safesearch will be enabled or disabled |
| CONFIG_DISABLE_BITTORRENT_SEARCH | false | boolean | Defines whether bittorrent support will be enabled or disabled |
| CONFIG_BITTORRENT_TRACKERS | "http://nyaa.tracker.wf:7777/announce" | string | Bittorrent trackers, see the complete example in the `config.php` file. |

<br>

### Wikipedia

| Variables | Default | Examples | Description |
|:----------|:-------------|:---------|:------|
| CONFIG_WIKIPEDIA_LANGUAGE | "en" | "pt", "es", "hu" | Adds language support for Wikipedia results |

<br>

### Applications

| Variables | Default | Examples | Description |
|:----------|:-------------|:---------|:------|
| APP_INVIDIOUS | "" | string | Integration with external self-hosted apps, configure the desired host. |
| APP_RIMGO | "" | string | Integration with external self-hosted apps, configure the desired host. |
| APP_SCRIBE | "" | string | Integration with external self-hosted apps, configure the desired host. |
| APP_LIBRARIAN | "" | string | Integration with external self-hosted apps, configure the desired host. |
| APP_GOTHUB | "" | string | Integration with external self-hosted apps, configure the desired host. |
| APP_NITTER | "" | string | Integration with external self-hosted apps, configure the desired host. |
| APP_LIBREREDDIT | "" | string | Integration with external self-hosted apps, configure the desired host. |
| APP_PROXITOK | "" | string | Integration with external self-hosted apps, configure the desired host. |
| APP_WIKILESS | "" | string | Integration with external self-hosted apps, configure the desired host. |
| APP_QUETRE | "" | string | Integration with external self-hosted apps, configure the desired host. |
| APP_LIBREMDB | "" | string | Integration with external self-hosted apps, configure the desired host. |
| APP_BREEZEWIKI | "" | string | Integration with external self-hosted apps, configure the desired host. |
| APP_ANONYMOUS_OVERFLOW | "" | string | Integration with external self-hosted apps, configure the desired host. |
| APP_SUDS | "" | string | Integration with external self-hosted apps, configure the desired host. |
| APP_BIBLIOREADS | "" | string | Integration with external self-hosted apps, configure the desired host. |

<br>

### Curl

| Variables | Default | Examples | Description |
|:----------|:-------------|:---------|:------|
| CURLOPT_PROXY_ENABLED | false | boolean | If you want to use a proxy, you need to set this variable to true. |
| CURLOPT_PROXY | "" | "127.0.0.1:8080" | Set the proxy using the ip and port to be used |
| CURLOPT_RETURNTRANSFER | true | boolean | **TODO** |
| CURLOPT_ENCODING | "" | string | Defines the encode that curl should use to display the texts correctly |
| CURLOPT_USERAGENT | "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36" | string | This variable defines the 'User-Agent' that curl will use to attempt to avoid being blocked |
| CURLOPT_CUSTOMREQUEST | "GET" | "HEAD", "OPTIONS" | Defines the HTTP method that curl will use to make the request |
| CURLOPT_MAXREDIRS | 5 | number | **TODO** |
| CURLOPT_TIMEOUT | 18 | number | Sets the maximum time curl will wait for a response before timing out |
| CURLOPT_VERBOSE | false | boolean | Specifies whether curl should display detailed information on stdout about the request and response when making requests. Setting to 'true' enables verbose mode |

<br>

### Docker version issues

If you are going to build your own docker image based on this repository, pay attention to your Docker version, because depending on how recent the installed version is, maybe you should use the `buildx` command instead of `build`.

Docker <= 20.10: `docker build`

Docker > 20.10: `docker buildx build`

<br>

### Building a docker image

If you don't want to use the image that is already available on `docker hub`, then you can simply build the Dockerfile directly from the github repository using the command:

```sh
docker build https://github.com/hnhx/librex.git -t librex:latest
```

```sh
docker run -d --name librex \
    -e CONFIG_GOOGLE_DOMAIN="com" \
    -e CONFIG_GOOGLE_LANGUAGE="en" \
    -p 8080:8080 \
    librex:latest
```

Or, instead of doing the build remotely, you still have the opportunity to `git clone` the repository, and build it locally with the command:

```sh
git clone https://github.com/hnhx/librex.git
cd librex/
docker build -t librex:latest .
```

<br>

### Support for different architectures

Supported architectures for the official Librex images include the same ones supported by Alpine itself, which are typically denoted as `linux/386`, `linux/amd64`, `linux/arm/v6`. If you need support for a different architecture, such as `linux/arm/v7`, you can modify the 'Dockerfile' to use a more comprehensive base image like `ubuntu:latest` instead.

In this case, you must run the `build` process specifying the desired architecture as shown in the example below:

```sh
docker buildx build \
    --no-cache \
    --platform linux/arm/v7 \
    --tag librex/librex:latest .
```

**OBS:** Keep in mind that this can cause some issues at build time, so you need to know a little about Dockerfiles to solve this problem for your specific case.
