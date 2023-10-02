ARG PHP_VERSION=8.2.11RC1-cli-bullseye
FROM php:${PHP_VERSION}
LABEL authors="Flavio Medeiros"

ARG APP_DIR=/var/www/html
ARG REDIS_LIB_VERSION=5.3.7
ARG NODE_VERSION=18

RUN apt-get update -y && apt-get install -y \
    apt-utils supervisor curl git sqlite3 fswatch \
    zlib1g-dev libzip-dev zip unzip libcap2-bin libpng-dev libpq-dev libxml2-dev \
    $PHPIZE_DEPS \
    libcurl4-openssl-dev pkg-config libssl-dev

RUN docker-php-ext-install opcache pcntl pdo pdo_pgsql pgsql session gd curl xml zip bcmath iconv fileinfo

RUN pecl update-channels \
    && pecl install ds igbinary swoole mongodb redis-${REDIS_LIB_VERSION} \
    && docker-php-ext-enable swoole mongodb redis

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

ENV XDEBUG_MODE=coverage

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sL https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

COPY .docker/local/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY .docker/local/php.ini "$PHP_INI_DIR/99_extra.ini"

WORKDIR $APP_DIR
RUN cd $APP_DIR
RUN chown www-data:www-data $APP_DIR

COPY --chown=www-data:www-data . $APP_DIR
RUN composer install --no-interaction
RUN npm install

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY .docker/local/entrypoint.sh /entrypoint.sh
ENTRYPOINT sh /entrypoint.sh
