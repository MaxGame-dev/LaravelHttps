FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    openssl \
    libzip-dev \
    libpng-dev \
    jpeg-dev \
    postgresql-dev \
    oniguruma-dev \
    icu-dev \
    git \
    nodejs \
    npm

RUN docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql gd intl mbstring exif opcache

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# SSL証明書と秘密鍵の生成
RUN mkdir -p /etc/nginx/ssl
# これがうまくいかないとnginxコンテナでこけるので、最悪手動実行必要
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/nginx/ssl/nginx.key -out /etc/nginx/ssl/nginx.crt -subj "/C=JP/ST=Tokyo/L=Tokyo/O=Localhost/OU=Development/CN=localhost"

WORKDIR /var/www/html

EXPOSE 9000

CMD ["php-fpm"]