FROM php:8.4-rc-zts-alpine3.20
WORKDIR /app
ENTRYPOINT ["php"]
CMD ["artisan", "serve"]
