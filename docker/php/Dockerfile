FROM php:8.2.2-fpm-alpine3.17

RUN apk update && \
    apk upgrade

RUN apk add --no-cache \
    curl \
    bash \
    nano \
    git \
    $PHPIZE_DEPS \
    icu \
    icu-dev \
    libxml2-dev \
    libpq-dev

RUN apk add --update linux-headers

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/bin \
    --filename=composer

RUN pecl update-channels && \
    pecl install xdebug

RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    intl \
    opcache

RUN docker-php-ext-enable \
    xdebug

ARG UNAME
ARG UID
ARG GID

ENV USR=$UNAME
ENV GRP=$UNAME

RUN addgroup \
    -g "$GID" \
    -S "$GRP" && \
	adduser \
	--disabled-password \
    --no-create-home \
    -g "$GID" \
	-D \
	-s "/bin/bash" \
	-u "$UID" \
	-G "$GRP" "$USR" && \
    echo "$USR ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

RUN chown -R $USR:$GRP "/var/www"

USER $USR:$GRP

