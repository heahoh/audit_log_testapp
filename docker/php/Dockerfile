FROM composer:latest AS composer
FROM php:8.2-fpm-alpine

RUN docker-php-ext-install pdo_mysql

RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS}
RUN apk add curl-dev openssl-dev
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb
RUN apk add --update linux-headers
RUN pecl install xdebug-3.2.0 \
    && docker-php-ext-enable xdebug

ADD ./docker/php/xdebug.ini "$PHP_INI_DIR/conf.d/xdebug.ini"
ADD ./ /var/www/app
WORKDIR /var/www/app

COPY --from=composer /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install