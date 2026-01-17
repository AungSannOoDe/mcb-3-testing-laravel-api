FROM ubuntu:latest

RUN apt-get update

RUN apt-get install -y openssl vim curl php8.3 php8.3-cli php8.3-fpm php8.3-mysql php8.3-gd php8.3-xml php8.3-mbstring php8.3-curl php8.3-zip php8.3-gd  php8.3-redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Example: Set upload_max_filesize for CLI
RUN sed -i 's/upload_max_filesize = .*/upload_max_filesize = 1000M/' /etc/php/8.3/cli/php.ini

# Example: Set post_max_size for CLI
RUN sed -i 's/post_max_size = .*/post_max_size = 1000M/' /etc/php/8.3/cli/php.ini

# Example: Set upload_max_filesize for FPM (if needed for web requests)
RUN sed -i 's/upload_max_filesize = .*/upload_max_filesize = 1000M/' /etc/php/8.3/fpm/php.ini

# Example: Set post_max_size for FPM (if needed for web requests)
RUN sed -i 's/post_max_size = .*/post_max_size = 1000M/' /etc/php/8.3/fpm/php.ini

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

RUN composer install

# RUN php artisan key:generate

# Run migrations and seeding
# RUN php artisan migrate:fresh --seed

# RUN chmod -R 777 ./storage

# RUN php artisan storage:link

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
EXPOSE 8000