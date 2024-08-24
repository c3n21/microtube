FROM php:8.4-rc-zts-alpine3.20
WORKDIR /app
CMD ["php","artisan", "serve", "--host=0.0.0.0",  "--port=8000"]
