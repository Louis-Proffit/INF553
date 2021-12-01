FROM php:alpine
RUN apk add libpq-dev
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql pgsql
WORKDIR /srv
EXPOSE 8080
CMD ["php", "-S","localhost:8080"]
