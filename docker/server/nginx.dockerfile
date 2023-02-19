# Install Nginx with FastCGI enabled, optimizing its performance for serving content
RUN apk add nginx

# After executing the 'docker run' command, run the 'prepare.sh' script
CMD [ "/bin/sh", "-c", "docker/server/prepare.sh" ]
