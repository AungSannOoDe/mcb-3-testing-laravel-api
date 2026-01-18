# Use PHP 8.3 FPM Alpine as the base
FROM php:8.3-fpm-alpine

# 1. Install Node.js (for Vite/Assets)
COPY --from=node:20-alpine /usr/lib /usr/lib
COPY --from=node:20-alpine /usr/local/share /usr/local/share
COPY --from=node:20-alpine /usr/local/lib /usr/local/lib
COPY --from=node:20-alpine /usr/local/bin /usr/local/bin

# 2. Install system dependencies
RUN apk add --no-cache \
    git curl libpng-dev libxml2-dev zip unzip oniguruma-dev libzip-dev

# 3. Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# 4. Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy all files
COPY . /var/www

# --- THE MISSING STEPS ---
# 5. Install PHP Dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 6. Install Node Dependencies and Build Assets
RUN npm install && npm run build
# -------------------------

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Expose port 8000 for Coolify
EXPOSE 8000

# Start Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]