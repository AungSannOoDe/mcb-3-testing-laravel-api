#!/bin/sh

# Wait for database (optional but helpful)
sleep 5 

# Clear cache so new .env values are loaded
php artisan config:clear
php artisan view:clear

# Run migrations
php artisan migrate --force || true

# Compile assets for Blade (If not done in Dockerfile)
npm run build || true

exec "$@"