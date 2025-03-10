# Utilisation de PHP 8.4 avec FPM
FROM php:8.4-fpm

ARG USER=dev

# Installation des dépendances système et extensions PHP
RUN apt-get update && apt-get install -y \
        libpq-dev \
        libzip-dev \
        libxslt1-dev \
        libonig-dev \
        zip \
        unzip \
        git \
        curl \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        librabbitmq-dev \
    && pecl install amqp \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip xsl gd intl opcache exif mbstring \
    && apt-get clean && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-enable amqp

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Créer un utilisateur dev
RUN groupadd ${USER} -g 1000 \
    && useradd ${USER} -g ${USER} -d /home/${USER} -m -ms /bin/bash

# Commande de démarrage
CMD ["php-fpm"]
