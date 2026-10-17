 FROM php:8.3-fpm
 WORKDIR /var/www
 ADD . /var/www
 
 RUN chown -R www-data:www-data /var/www
 
 RUN cd /usr/bin && curl -fsSL https://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer
 
 RUN apt-get update \
   && apt-get install -y \
   gcc \
   make \
   git \
   unzip \
   vim \
   libpng-dev \
   libjpeg-dev \
   libfreetype6-dev \
   libmcrypt-dev \
   libpq-dev \
   curl \
   gnupg \
   openssl \
   && docker-php-ext-install pdo_mysql mysqli \
   && docker-php-ext-configure gd --with-freetype --with-jpeg \
   && docker-php-ext-install -j$(nproc) gd \
   && apt-get clean \
   && rm -rf /var/lib/apt/lists/*

 # Install PhpRedis extension
 RUN pecl install redis \
   && docker-php-ext-enable redis
 
 
 COPY php.ini /usr/local/etc/php/
 
 
 RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
   && apt-get update \
   && apt-get install -y nodejs \
   && apt-get clean \
   && rm -rf /var/lib/apt/lists/* 
 
 RUN npm install -g n \
   && n stable \
   && npm update -g npm