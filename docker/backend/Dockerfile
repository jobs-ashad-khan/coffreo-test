# Utilisation de PHP 8.4 avec FPM
FROM php:8.4-fpm

ARG USER=dev

# Installation des extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libpq-dev zip unzip git curl libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql gd opcache

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Installer les dépendances Symfony
COPY backend /var/www
RUN composer install

# Donne les droits d'écriture
RUN chown -R www-data:www-data /var/www/var

# Créer un utilisateur dev
RUN groupadd ${USER} -g 1000 \
    && useradd ${USER} -g ${USER} -d /home/${USER} -m -ms /bin/bash

# Commande de démarrage
CMD ["php-fpm"]
