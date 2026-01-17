#!/bin/bash
set -e

# Ensure storage directories exist (VERY IMPORTANT FOR VOLUMES)
mkdir -p \
  /var/www/html/storage/logs \
  /var/www/html/storage/app/public \
  /var/www/html/storage/framework/cache \
  /var/www/html/storage/framework/sessions \
  /var/www/html/storage/framework/views

chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage

# Run migrations (safe)
php artisan migrate --force || true

# Create storage link (safe)
php artisan storage:link || true

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=8000 
