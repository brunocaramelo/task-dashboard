FROM composer:2.8.9 as builder

COPY . /app

WORKDIR /app

RUN composer install  \
    --ignore-platform-reqs \
    --no-ansi \
    --no-autoloader \
    --no-interaction \
    --no-scripts \
    --prefer-dist

RUN composer dump-autoload --optimize --classmap-authoritative

FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
      zlib1g-dev \
      sqlite3 \
      libsqlite3-dev \
      libicu-dev \
      libpq-dev \
      libmcrypt-dev \
      libzip-dev \
    && rm -r /var/lib/apt/lists/* \
    && docker-php-ext-install exif \
    && docker-php-ext-install pdo pdo pdo_pgsql \
    && docker-php-ext-install \
      intl \
      pdo_pgsql \
      pcntl \
      pdo_sqlite \
      pgsql \
      zip \
      opcache

COPY --from=builder /app /app

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

WORKDIR /app

RUN sed -e '/^access.log =/s/^/;/' -i /usr/local/etc/php-fpm.d/docker.conf
RUN sed -e 's/pm.max_children = 5/pm.max_children = 40/' -i /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/pm.start_servers = 2/pm.start_servers = 15/" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/pm.min_spare_servers = 1/pm.min_spare_servers = 10/" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/pm.max_spare_servers = 3/pm.max_spare_servers = 15/" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/;pm.max_requests = 500/pm.max_requests = 500/" /usr/local/etc/php-fpm.d/www.conf

RUN chown -R www-data:www-data /app

RUN chmod +x startup-app.sh

CMD ["php-fpm"]
