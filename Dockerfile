FROM composer:2.7.9 AS composer_bin

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
    $PHPIZE_DEPS

# PHP extensions (Laravel)
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    intl \
    mbstring \
    zip \
    opcache

COPY --from=composer_bin /usr/bin/composer /usr/local/bin/composer
# Install Composer (no composer image needed)
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

# PHP upload limits (1000MB)
COPY /php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini

WORKDIR /var/www

COPY . .

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

    RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
    RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache
    
    
    RUN php artisan config:clear
EXPOSE 8000
CMD ["php","artisan","serve","--host=0.0.0.0","--port=8000"]
