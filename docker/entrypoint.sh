#!/bin/bash

set -e


envsubst < docker/.env.docker > .env

/usr/local/bin/docker-php-entrypoint $@
