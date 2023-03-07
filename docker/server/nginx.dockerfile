# Install Nginx with FastCGI enabled, optimizing its performance for serving content
RUN apk add nginx

# Forward request and error logs to docker log collector
# RUN ln -sf /dev/stdout /var/log/nginx/access.log &&\
#     ln -sf /dev/stderr /var/log/nginx/error.log

# After executing the 'docker run' command, run the 'prepare.sh' script
CMD [ "/bin/sh", "-c", "docker/server/prepare.sh" ]
