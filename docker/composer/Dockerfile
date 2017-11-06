FROM php:5.6
WORKDIR /temp

RUN apt-get update && apt-get install -y unzip git

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN composer self-update

RUN mkdir /data
VOLUME ["/data"]
WORKDIR /data

ENTRYPOINT ["composer"]
CMD ["--help"]
