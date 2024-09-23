#!/bin/bash

# Esegui composer install
docker exec -ti laravel composer install
docker exec -ti laravel copy .env.docker .env
docker exec -ti laravel php artisan key:generate
docker exec -ti laravel php artisan migrate
docker exec -ti laravel php artisan passport:keys
docker exec -ti laravel php artisan passport:client --personal --name "Personal Access Client" --no-interaction
docker exec -ti laravel php artisan passport:client --password --name "Password Grant Client" --no-interaction
docker exec -ti laravel php artisan db:seed


