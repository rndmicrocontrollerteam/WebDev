# Menggunakan image PHP sebagai dasar
FROM php:8.1-fpm

# Instal dependensi
RUN apt-get update && apt-get install -y libzip-dev libpng-dev \
    && docker-php-ext-install zip gd

RUN docker-php-ext-install pdo pdo_mysql

# Set working directory
WORKDIR /var/www

# Salin Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin file aplikasi Laravel ke container
COPY ./laravel-app /var/www

# Instal dependensi Laravel
RUN composer install

# Ekspose port untuk PHP-FPM
EXPOSE 9000
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
CMD ["php-fpm"]