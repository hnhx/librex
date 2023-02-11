#!/bin/sh

# The block below will use iteration to either build the necessary Docker image or simply run the required containers using the provided entrypoint arguments
# First, the image will be created, and then the container will be run using the image that was generated
for image in "$@"
do
    # The following command will display the IDs of Docker images filtered by name
    # See more: https://docs.docker.com/engine/reference/commandline/images/
    if [ ! "$(docker images -aq --filter 'reference=${image}')" ]; then
        docker buildx build -f scripts/${image}.dockerfile -t ${image}:latest scripts/
    fi

    # The following command will achieve the same result as the previous command, but for containers rather than images
    # See more: https://docs.docker.com/engine/reference/commandline/ps/
    if [ ! "$(docker ps -aq --filter name=${image})" ]; then
        [ "$(docker ps -aq --filter status=exited -f name=${image})" ] && docker rm ${image}
        docker run -d --name ${image} ${image}:latest
    fi
done

exec sleep infinity
