## Introduction

The 'Dockerfile' located in the root directory will copy all Docker scripts from the current directory to the container and build them inside the 'librex:latest' container. The files inside the 'templates' directory contain variables that will be replaced by 'build.sh' with arguments from the Dockerfiles.

- Why are 'Docker-in-Docker' containers being run in this project?
