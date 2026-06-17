FROM laravelsail/php84-composer:latest

RUN apt-get update && apt-get install -y nodejs npm

WORKDIR /app
