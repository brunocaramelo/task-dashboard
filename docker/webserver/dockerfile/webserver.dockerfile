FROM dunglas/frankenphp:1.3.6-php8.4

ENV WEBSERVER_PORT=${WEBSERVER_PORT:-8003}

RUN apt-get update && apt-get install -y \
      libzip-dev \
      sqlite3 \
      libsqlite3-dev \
      libicu-dev \
      libpq-dev \
      && docker-php-ext-install zip pdo_mysql \
      pdo_pgsql \
      pdo_sqlite \
      pcntl \
      posix

WORKDIR /app

COPY docker/webserver/config/Caddyfile /etc/caddy/Caddyfile

COPY docker/webserver/startup/startup.sh /app/startup.sh

RUN chmod +x /app/startup.sh

# RUN chown -R www-data:www-data /app \
#     && mkdir -p /app/storage /app/bootstrap/cache \
#     && chmod -R ug+w /app/storage /app/bootstrap/cache

# USER www-data

EXPOSE ${WEBSERVER_PORT}


CMD ["/bin/bash", "-c", "/app/startup.sh --webserver-port=${WEBSERVER_PORT}"]
