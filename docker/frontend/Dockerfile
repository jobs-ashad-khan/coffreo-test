# Utilisation de l'image Node.js LTS
FROM node:20-alpine

ARG USER=node

# Définition du répertoire de travail
WORKDIR /app

# Copier uniquement les fichiers nécessaires pour optimiser le cache
COPY frontend/package.json frontend/package-lock.json ./

# Donner les droits à l'utilisateur
RUN chown -R ${USER}:${USER} /app

# Passer en utilisateur non-root
USER ${USER}

# Installation des dépendances
RUN npm install

# Copier le projet Next.js
COPY frontend/ ./

# Repasser en root pour modifier les permissions de node_modules/
USER root
RUN chown -R ${USER}:${USER} /app/node_modules

# Lancer Next.js en mode développement
CMD ["npm", "run", "dev"]