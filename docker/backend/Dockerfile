# Utilisation de PHP 8.4 avec FPM
FROM php:8.4-fpm

ARG USER=dev

# Installation des dépendances système et extensions PHP
RUN apt-get update && apt-get install -y \
    libpq-dev zip unzip git curl libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql gd opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Créer un utilisateur dev
RUN groupadd ${USER} -g 1000 \
    && useradd ${USER} -g ${USER} -d /home/${USER} -m -ms /bin/bash

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définition du répertoire de travail
WORKDIR /var/www

# Donner les droits à l'utilisateur
RUN chown -R ${USER}:${USER} /var/www

# Passer en utilisateur non-root
USER ${USER}

# Copier uniquement les fichiers nécessaires pour optimiser le cache Docker
COPY backend/composer.json backend/composer.lock ./

# Installation des dépendances PHP
RUN composer install --no-dev --prefer-dist --no-progress --no-scripts

# Copier le reste du projet Symfony
COPY backend/ ./

# Commande de démarrage
CMD ["php-fpm"]
