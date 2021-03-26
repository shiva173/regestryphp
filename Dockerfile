FROM php:7.2-apache

RUN apt-get update
RUN apt-get install apache2 -y \
	vim \
	nano \
	libxml2-dev \
	git \
	libzip-dev
    


RUN docker-php-ext-install soap calendar mysqli 


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install mongodb-1.4.4 && pecl install xdebug-2.8.1 && docker-php-ext-enable mongodb xdebug 

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini


RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/us$ && docker-php-ext-install -j$(nproc) gd



RUN a2enmod rewrite;
RUN a2enmod headers;

#RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/php.ini
#RUN echo "xdebug.remote_host=192.168.10.190" >> /usr/local/etc/php/php.ini
#RUN echo "xdebug.remote_handler=dbgp"  >> /usr/local/etc/php/php.ini
#RUN echo "xdebug.remote_host=localhost"  >> /usr/local/etc/php/php.ini
#RUN echo "xdebug.remote_port=9001"  >> /usr/local/etc/php/php.ini
#RUN echo "xdebug.remote_autostart=1"  >> /usr/local/etc/php/php.ini
#RUN echo "xdebug.idekey=\"PHPSTORM\""  >> /usr/local/etc/php/php.ini
#RUN echo "xdebug.max_nesting_level=100000"  >> /usr/local/etc/php/php.ini

RUN service apache2 restart

