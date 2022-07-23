FROM devilbox/php-fpm-8.1
ARG PHP_EXTRA_CONFIGURE_ARGS --enable-fpm --with-fpm-user=www-data --with-fpm-group=www-data --disable-cgi --enable-fd-setsize=2048  --enable-pcntl
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        libicu-dev \
        g++ \
        libonig-dev \
        libxslt-dev \
        zlib1g-dev \
        libxml2-dev \
        libsqlite3-dev \
        libpng-dev \
        libzip-dev \
        vim curl debconf subversion git apt-transport-https apt-utils \
        build-essential locales acl mailutils wget nodejs zip unzip \
        gnupg gnupg1 gnupg2 zlib1g-dev \
        librabbitmq-dev \
        libssh-dev \
        sudo \
        ssh \
        && pecl install amqp  \
        && docker-php-ext-enable amqp\
    && docker-php-ext-install \
        pdo_mysql \
        pdo_sqlite \
        soap \
        zip \
        dom\
        xsl\
        opcache \
        gd \
        dom\
        mbstring \
        calendar \
        intl
COPY infra/fpm/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY infra/fpm/custom.ini /usr/local/etc/php/conf.d/custom.ini

WORKDIR /var/www/default/htdocs