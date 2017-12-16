FROM php:7.1-apache

MAINTAINER tshinowpub <shino.t.music@gmail.com>

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# Install middleware
RUN apt-get update \
    && apt-get install -y \
        curl \
        cron \
        g++ \
        git \
        gcc \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libxml2-dev \
        libxslt1-dev \
        make \
        mc \
        tar \
        unzip \
        vim \
        wget

# Setting PHP
RUN docker-php-ext-configure \
  gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/

RUN docker-php-ext-install \
    bcmath \
    gd \
    hash \
    intl \
    json \
    mbstring \
    mcrypt \
    mysqli \
    opcache \
    pdo \
    pdo_mysql \
    simplexml \
    zip

# Setting Xdebug
RUN pecl install xdebug \
  && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
  && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
  && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini \
  && echo "xdebug.remote_connect_back=off" >> /usr/local/etc/php/conf.d/xdebug.ini \
  && echo "xdebug.remote_host=ide.local" >> /usr/local/etc/php/conf.d/xdebug.ini \
  && echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini \
  && echo "xdebug.remote_log=/tmp/php5-xdebug.log" >> /usr/local/etc/php/conf.d/xdebug.ini

# Setting Apache
COPY env/notification.conf /etc/apache2/sites-available/notification.conf
RUN a2dissite 000-default.conf && a2ensite notification.conf && a2enmod rewrite

# Copy PHP.ini
COPY env/php.ini /usr/local/etc/php/

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www/html

CMD ["apache2-foreground"]
