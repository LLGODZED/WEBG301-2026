#!/usr/bin/env bash
set -e

cd /var/www/html

if [ ! -f .env ]; then
  cp .env.example .env
fi

if [ -z "$(grep '^APP_KEY=base64:' .env || true)" ]; then
  php artisan key:generate --force
fi

echo "Waiting for database..."
until mysqladmin ping -h"${DB_HOST:-db}" -u"${DB_USERNAME:-conference_user}" -p"${DB_PASSWORD:-conference_pass}" --silent; do
  sleep 2
done

php artisan migrate --force
php artisan db:seed --force
php artisan config:clear
php artisan route:clear
php artisan view:clear

chown -R www-data:www-data storage bootstrap/cache

exec "$@"
