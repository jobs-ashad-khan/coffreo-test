# Utilisation de l'image Node.js LTS
FROM node:20

WORKDIR /app

# Copier le projet Next.js
COPY frontend/ ./

# Installation des dépendances
RUN npm install

# Lancer Next.js en mode développement
CMD ["npm", "run", "dev"]