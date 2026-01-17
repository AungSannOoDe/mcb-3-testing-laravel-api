FROM php:8.4-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    bash git curl zip unzip \
    sqlite sqlite-dev \
    libpng-dev libzip-dev oniguruma-dev libxml2-dev \
    nodejs npm \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring zip exif pcntl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader || true

# Install npm deps (if exists)
RUN [ -f package.json ] && npm install || true

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["entrypoint.sh"]

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
