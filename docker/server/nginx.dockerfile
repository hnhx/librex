RUN apk add nginx

ADD "docker/server/fastcgi.conf" /etc/nginx/fastcgi.conf
ADD "docker/server/nginx.conf" /etc/nginx/http.d/librex.conf

RUN chmod u+x "/etc/nginx/fastcgi.conf" &&\
    chmod u+x "/etc/nginx/http.d/librex.conf"

CMD [ "/bin/sh", "-c", "docker/server/prepare.sh" ]
