FROM php:8.3-cli-alpine

RUN apk add --no-cache \
    bash \
    git \
    unzip \
    autoconf \
    g++ \
    make \
    libtool \
    icu-dev \
    bash \
    file \
    zlib-dev \
    bzip2-dev \
    oniguruma-dev

RUN docker-php-ext-install mbstring pcntl bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-interaction --prefer-dist

CMD vendor/bin/pest
