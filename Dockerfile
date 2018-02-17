FROM php:7.0-apache

RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libmcrypt-dev \
		libpng-dev \
	&& docker-php-ext-install -j$(nproc) iconv mcrypt \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
	&& docker-php-ext-install -j$(nproc) gd \
	&& docker-php-ext-install mysqli \
	&& docker-php-ext-enable mysqli
#	&& curl -sS https://getcomposer.org/installer | php
#	&& php composer.phar require aws/aws-sdk-php

COPY app /var/www/html/

RUN chmod 777 -R /var/www/html
