FROM php:8.2-fpm-alpine

RUN apk update && apk upgrade && apk add  --no-cache $PHPIZE_DEPS \
    && apk add --no-cache linux-headers git \
    curl \
    zip \
    unzip \
    icu-dev 


RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-configure intl && docker-php-ext-install intl

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY ./conf.d/xdebug.ini "${PHP_INI_DIR}/conf.d"

WORKDIR /var/www


RUN mkdir -p ./storage/cache && chmod 777 ./storage/cache 