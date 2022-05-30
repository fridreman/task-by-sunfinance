FROM php:8.1.3RC1-fpm as base

RUN apt-get update && apt-get install -y --no-install-recommends gnupg \
    netcat \
    sudo \
    libicu-dev \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libxml2-dev \
    libsodium-dev \
    libxslt-dev \
    libzip-dev \
    rsync \
    unzip \
    nano \
    vim \
    less \
    cron \
    iputils-ping \
    iproute2 \
    librabbitmq-dev \
    libpq-dev \
    ;

RUN pecl install xdebug amqp;
RUN docker-php-ext-enable amqp;

RUN apt-get update

RUN apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev libfreetype6-dev

RUN docker-php-ext-configure gd --with-webp --with-jpeg --with-xpm --with-freetype

RUN docker-php-ext-install bcmath \
    intl \
    gd \
    opcache \
    soap \
    xsl \
    pdo \
    pdo_pgsql \
    pgsql \
    zip \
    sockets \
    ;

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

WORKDIR /var/www/

CMD ["php", "./container_start.php"]
