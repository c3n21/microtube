ARG COMPOSER_VERSION=2.2.24
ARG PHP_VERSION=8.3.11RC2-zts-alpine3.20
ARG NODE_VERSION=22.8.0-alpine3.19
ARG PNPM_VERSION=9.9.0

FROM php:$PHP_VERSION as base
WORKDIR /app

FROM node:$NODE_VERSION as pnpm
RUN npm i -g pnpm@$PNPM_VERSION

FROM composer:$COMPOSER_VERSION as composer

FROM base as local
CMD ["php","artisan", "serve", "--host=0.0.0.0",  "--port=8000"]

# production
FROM composer:$COMPOSER_VERSION as production_build
VOLUME /app
WORKDIR /app
COPY . .
RUN composer install
FROM production_build as production
RUN <<OPTIMIZE
php artisan optimize:clear
php artisan optimize
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
OPTIMIZE
