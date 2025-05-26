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

COPY docker/startup/startup-app.sh startup-app.sh

RUN composer dump-autoload --optimize --classmap-authoritative


FROM node:22 as build-frontend

WORKDIR /app

COPY ./package.json ./package-lock.json /app/

COPY \
  --from=builder \
  /app/vendor /app/vendor

RUN npm install

COPY . /app

RUN mkdir -p /app/build

RUN npm run build

RUN cp /app/public/build/.vite/manifest.json /app/public/build/manifest.json



FROM nginx:1.27.5-alpine

COPY --from=build-frontend /app /app

RUN rm -rf /etc/nginx/conf.d/default.conf

WORKDIR /app


CMD ["nginx", "-g", "daemon off;"]
