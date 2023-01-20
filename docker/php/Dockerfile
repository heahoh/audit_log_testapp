FROM php:8.2-fpm-alpine
RUN docker-php-ext-install pdo_mysql

RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS}
RUN pecl install mongodb \
        &&  echo "extension=mongodb.so" > $PHP_INI_DIR/conf.d/mongo.ini