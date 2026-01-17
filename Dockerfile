FROM php:8.4-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    bash git curl zip unzip \
    libpng-dev libzip-dev oniguruma-dev libxml2-dev \
    nodejs npm \
    $PHPIZE_DEPS

# Install PHP extensions (MySQL only to prevent SQLite fallback)
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Build Frontend Assets (Critical for Blade/Vite)
RUN npm install && npm run build

# Create necessary directories and set permissions
RUN mkdir -p storage/framework/views storage/framework/sessions storage/framework/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy and prepare entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["entrypoint.sh"]

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]