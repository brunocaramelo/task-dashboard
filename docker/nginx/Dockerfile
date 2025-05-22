FROM composer:2.8.9 as builder

COPY . /app

COPY \
  --from=builder \
  /app/vendor /app/vendor

WORKDIR /app

RUN composer install  \
    --ignore-platform-reqs \
    --no-ansi \
    --no-autoloader \
    --no-interaction \
    --no-scripts \
    --prefer-dist

COPY docker/startup/startup-app.sh startup-app.sh

RUN composer dump-autoload --optimize --classmap-authoritative



FROM node:22 as build-frontend

WORKDIR /app

COPY ./package.json ./package-lock.json /app/

RUN npm install

COPY . /app

RUN npm run build

FROM nginx:1.27.5-alpine

COPY --from=build-frontend /app/public /app/public

RUN rm -rf /etc/nginx/conf.d/default.conf

WORKDIR /app

RUN ls -la public/build/assets
RUN ls -la /app

CMD ["nginx", "-g", "daemon off;"]
