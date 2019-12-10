FROM php:7.2-fpm

RUN printf "deb http://archive.debian.org/debian/ jessie main\n\
    deb-src http://archive.debian.org/debian/ jessie main\n\
    deb http://security.debian.org jessie/updates main\n\
    deb-src http://security.debian.org jessie/updates main"\
 > /etc/apt/sources.list

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    yum

RUN apt-get update && apt-get install -y libtool m4 automake autoconf autotools-dev libboost-all-dev 

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install zip
RUN docker-php-ext-install sockets
RUN apt-get update && apt-get install -y nano vim
RUN pecl install mongodb
RUN docker-php-ext-install bcmath

RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/docker-php-ext-mongodb.ini
RUN echo "memory_limit=512M" >> /usr/local/etc/php/conf.d/docker-php-ext-memory_limit.ini

ENV CURRENT_USER $UID:$GID
