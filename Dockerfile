# 1) Install PHP dependencies
FROM ghcr.io/eventpoints/php:sha-ea6c165 AS composer

ENV APP_ENV="prod" \
    APP_DEBUG=0 \
    PHP_OPCACHE_PRELOAD="/app/config/preload.php" \
    PHP_EXPOSE_PHP="off" \
    PHP_OPCACHE_VALIDATE_TIMESTAMPS=0

# Turn off Xdebug in prod
RUN rm -f /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Prepare cache/log dirs
RUN mkdir -p var/cache var/log

# Copy only the lock/files for installing deps
COPY composer.json composer.lock symfony.lock ./

RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts

# 2) Copy app source & finalize PHP build
FROM composer AS php

# Copy your application code
COPY . .

# Re-run install now that source & scripts are present
RUN composer install --no-dev --no-interaction --classmap-authoritative \
 && composer symfony:dump-env prod \
 && chmod -R 777 var

# 3) Final Caddy image
FROM ghcr.io/eventpoints/caddy:sha-fc43d4e AS caddy

# Expose your built public folder
COPY --from=php /app/public public/
