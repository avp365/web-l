FROM composer:1.10.25 as build-dev
RUN mkdir -p /app
WORKDIR /app
COPY . /app/
RUN /usr/bin/composer install --ignore-platform-reqs

FROM  php:7.4-fpm as php_base

WORKDIR /app

RUN usermod -u 1000 www-data
# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libmemcached-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libpq-dev \
    libzip-dev \
    net-tools
# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
# Install extensions
RUN docker-php-ext-install pdo_pgsql zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

RUN mkdir -p /app

COPY --from=build-dev /app /app
RUN chown -R www-data /app


