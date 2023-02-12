RUN apk add nginx

CMD [ "/bin/sh", "-c", "docker/server/prepare.sh" ]
