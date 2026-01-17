# Use the official PHP 8.4 FPM image as a base
FROM php:8.4-fpm

# 1. Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    supervisor \
    && rm -rf /var/lib/apt/lists/*

# 2. Install required PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    gd \
    zip \
    pcntl

# 3. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Set PHP upload limits
RUN echo "upload_max_filesize=1000M" > /usr/local/etc/php/conf.d/uploads.ini \
 && echo "post_max_size=1000M" >> /usr/local/etc/php/conf.d/uploads.ini

# 5. Set working directory (IMPORTANT)
WORKDIR /var/www/html

# 6. Copy application code
COPY . .


# 8. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# 9. Create storage directories BEFORE supervisor
RUN mkdir -p storage/logs \
    storage/app/public \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
 && chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# 10. Create storage symlink
RUN php artisan storage:link || true

# 11. Expose port (if using php artisan serve)
EXPOSE 8000

# 12. Start services
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
CMD ["/entrypoint.sh"]