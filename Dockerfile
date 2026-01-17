FROM composer:2.7.9 AS composer_bin

# Using PHP 8.4
FROM php:8.4.2-fpm-alpine3.20

# System & build dependencies
RUN apk update && apk add --no-cache \
    bash \
    curl \
    git \
    unzip \
    icu-dev \
    oniguruma-dev \
    libzip-dev \
    nodejs \
    npm \
    $PHPIZE_DEPS

# PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    intl \
    mbstring \
    zip \
    opcache

COPY --from=composer_bin /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install & Build Frontend Assets (Required for Blade/Vite)
RUN npm install && npm run build

# Fix Permissions for Blade and Cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Clear everything to prevent 500 errors from old cache
RUN php artisan config:clear
RUN php artisan view:clear

EXPOSE 8000

# Start Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]