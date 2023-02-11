#!/bin/sh

# You can split the value of the --images argument using the IFS (Internal Field Separator) variable and the read command,
# and then iterate over the resulting parts using a for loop.
# See more: https://unix.stackexchange.com/questions/184863/what-is-the-meaning-of-ifs-n-in-bash-scripting
IFS='=' read -ra ARGUMENT_PARTS <<< "$1"
IFS='/' read -ra IMAGE_PARTS <<< "${ARGUMENT_PARTS[1]}"

# The block below will use iteration to either build the necessary Docker image or simply run the required containers using the provided entrypoint arguments
# First, the image will be created, and then the container will be run using the image that was generated
for IMAGE in "${IMAGE_PARTS[@]}"
do
    # The following command will display the IDs of Docker images filtered by name
    # See more: https://docs.docker.com/engine/reference/commandline/images/
    if [ ! "$(docker images -aq --filter 'reference=${IMAGE}')" ]; then
        docker buildx build -f scripts/${IMAGE}.dockerfile -t ${IMAGE}:latest scripts/
    fi

    # The following command will achieve the same result as the previous command, but for containers rather than images
    # See more: https://docs.docker.com/engine/reference/commandline/ps/
    if [ ! "$(docker ps -aq --filter name=${IMAGE})" ]; then
        [ "$(docker ps -aq --filter status=exited -f name=${IMAGE})" ] && docker rm ${IMAGE}
        docker run -d --name ${IMAGE} ${IMAGE}:latest
    fi
done

exec sleep infinity
