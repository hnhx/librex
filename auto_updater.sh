#!/bin/sh
while true; do
	git stash
	git pull
	sleep 60
done
	
