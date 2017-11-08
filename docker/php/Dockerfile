FROM php:7.0-apache
COPY php.ini /usr/local/etc/php/
RUN a2enmod rewrite
RUN apt-get update \
  && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng12-dev libmcrypt-dev \
  && docker-php-ext-install pdo_mysql mysqli mbstring gd iconv mcrypt
