FROM php:8.3-fpm


RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev git unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www


COPY . .


RUN composer install --no-interaction --prefer-dist


EXPOSE 9000

CMD ["php-fpm"]
