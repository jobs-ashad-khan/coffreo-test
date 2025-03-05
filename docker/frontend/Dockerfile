# Utilisation de l'image Node.js LTS
FROM node:20-alpine

WORKDIR /app

# Copier uniquement les fichiers nécessaires pour optimiser le cache
COPY frontend/package.json frontend/package-lock.json ./

# Installation des dépendances
RUN npm install

# Copier le projet Next.js
COPY frontend/ ./

# Lancer Next.js en mode développement
CMD ["npm", "run", "dev"]