FROM php:7.4-fpm

COPY /composer*.json /var/www/

ARG user
ARG uid

RUN useradd -G www-data,root -u "$uid" -d /home/"$user" "$user"
RUN mkdir -p /home/"$user"/.composer && \
   chown -R "$user":"$user" /home/"$user"

WORKDIR /var/www/


RUN apt-get update && apt-get install -y \
    build-essential \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    nodejs\
    git \
    curl\
    tzdata\
    libicu-dev\
    && rm -rf /var/lib/apt/lists/* \
    && echo "es_ES.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen es_ES.UTF-8


RUN docker-php-ext-install pdo_mysql zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

RUN curl -sSL https://getcomposer.org/installer > composer-setup.php \
    && curl -sSL https://composer.github.io/installer.sha384sum > composer-setup.sha384sum \
    && sha384sum --check composer-setup.sha384sum \

    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer --2 \

RUN composer install

RUN echo "America/Santiago" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata

COPY . /var/www/

USER "$user"
EXPOSE 9000

CMD ["php-fpm", "-F"]
