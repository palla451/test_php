#!/bin/bash

set -e


envsubst < docker/.env.docker > .env
