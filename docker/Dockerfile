FROM php:8.3-fpm

ARG user
ARG uid

ENV SUPERVISOR_PHP_COMMAND="php -d variables_order=EGPCS /var/www/html/artisan serve --host=0.0.0.0 --port=80"
ENV SUPERVISOR_PHP_QUEUE_COMMAND="php -d variables_order=EGPCS /var/www/html/artisan queue:work --queue=default --tries=3"
ENV SUPERVISOR_PHP_USER="nobody"

WORKDIR /var/www/html

ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN pear update-channels
RUN pecl update-channels

RUN pecl install redis \
    && docker-php-ext-enable redis

RUN apt-get install -y libmemcached-dev zlib1g-dev libssl-dev
RUN yes '' | pecl install -f memcached-3.2.0 \
  && docker-php-ext-enable memcached
# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y supervisor
RUN mkdir -p /var/log/supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY run.sh /tmp
RUN ["chmod", "+x", "/tmp/run.sh"]

ENTRYPOINT ["/tmp/run.sh"]

EXPOSE 80
