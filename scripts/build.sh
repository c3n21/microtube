#/bin/sh
composer install
pnpm install
pnpm run build
php artisan key:generate
