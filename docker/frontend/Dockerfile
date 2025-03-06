# Utilisation de l'image Node.js LTS
FROM node:20-alpine

# Définition du répertoire de travail
WORKDIR /app

# Copier uniquement les fichiers nécessaires pour optimiser le cache
COPY frontend/package.json frontend/package-lock.json ./

# Donner les droits à l'utilisateur
RUN chown -R node:node /app

# Passer en utilisateur non-root
USER node

# Installation des dépendances
RUN npm install

# Copier le projet Next.js
COPY frontend/ ./

# Lancer Next.js en mode développement
CMD ["npm", "run", "dev"]