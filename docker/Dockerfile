FROM php:8.2-fpm

RUN apt-get update && \
    apt-get install -y \
    curl \
    git \
    unzip \
    libmcrypt-dev \
    libicu-dev \
    libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    libonig-dev \ 
    && docker-php-ext-install pdo_mysql mysqli mbstring intl zip exif pcntl bcmath soap gd opcache \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# WORKDIR /var/www

COPY . /var/www
WORKDIR /var/www

RUN composer install --prefer-dist \
    && npm install \
    && npm run build \
    && chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache 

# RUN php artisan migrate && php artisan db:seed && tail -f /dev/null

# RUN curl -L https://github.com/vishnubob/wait-for-it/raw/master/wait-for-it.sh > /usr/local/bin/wait-for-it \
#     && chmod +x /usr/local/bin/wait-for-it

# CMD /usr/local/bin/wait-for-it database:3306 -- php artisan migrate && php artisan db:seed && tail -f /dev/null
