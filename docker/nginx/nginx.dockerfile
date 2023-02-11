# syntax=docker/dockerfile:1
ARG VERSION="3.17"
FROM alpine:${VERSION} AS builder
WORKDIR "/home/librex"
