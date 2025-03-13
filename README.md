# Simulation de Machine à Café (Coffreo)

Ce projet est une simulation d'une machine à café full stack utilisant PHP 8.4 / Symfony 6.4 pour le backend, Next.js pour le frontend, RabbitMQ pour la gestion des commandes de café en file d'attente et Mercure pour l'affichage du statut des commandes de café en temps réel.

## Table des Matières

- [Prérequis](#pr%C3%A9requis)
- [Installation](#installation)
- [Architecture du Projet](#architecture-du-projet)
- [Utilisation](#utilisation)
- [Technologies Utilisées](#technologies-utilis%C3%A9es)
- [Commandes Utiles](#commandes-utiles)

---

## Prérequis

- **Docker** et **Docker Compose** installés
- **Make** installé
- **Node.js** et **npm** pour le développement frontend

## Installation

Clonez le dépôt et accédez au dossier du projet :

```sh
  git clone https://github.com/jobs-ashad-khan/coffreo-test
  cd coffreo-test
```

Créez un fichier `.env` à la racine et configurez les variables d'environnement nécessaires (voir `.env.example`).

Démarrez les services Docker :

```sh
  make up
```

Installez les dépendances backend et frontend :

```sh
  make install_backend
  make install_frontend
```

L'application est maintenant prête à l'emploi !

## Architecture du Projet

```
docker/
    backend/
        Dockerfile
    frontend/
        Dockerfile
mercure/
backend/
    src/
        Controller/
        DataFixtures/
        DTO/
        Entity/
        Enum/
        Message/
        MessageHandler/
        Repository/
        Service/
frontend/
    app/
    types/
    utils/
docker-compose.yml
.env
Makefile
```

## Utilisation

- **Backend Symfony** accessible sur `http://localhost:8000`
- **Frontend Next.js** accessible sur `http://localhost:3000`
- **Mercure** accessible sur `http://localhost:1337`
- **RabbitMQ Management UI** accessible sur `http://localhost:15672` (user/password via `.env`)

## Technologies Utilisées

- **Backend** : PHP 8.4, Symfony 6.4
- **Frontend** : Next.js
- **Messagerie** : RabbitMQ
- **Temps réel** : Mercure
- **Base de données** : PostgreSQL
- **Serveur web** : Nginx

## Commandes Utiles

Démarrer et arrêter les containers :

```sh
  make up       # Build et démarre les containers
  make down     # Stoppe les containers
  make restart  # Redémarre les services backend, frontend, RabbitMQ et Mercure
```

Accéder aux différents containers :

```sh
  make coffreo_backend   # Accès au backend
  make coffreo_frontend  # Accès au frontend
  make coffreo_db        # Accès à la base de données
```

Gérer la base de données :

```sh
  make backend_dependencies # Installe les dépendances backend
  make db_migrations        # Exécute les migrations
  make db_fixtures          # Charge les fixtures
```

Consulter les logs :

```sh
  make log-backend   # Logs du backend
  make log-nginx     # Logs du serveur Nginx
  make log-rabbitmq  # Logs de RabbitMQ
  make log-mercure   # Logs de Mercure
```

Lancer la consommation des messages RabbitMQ (obligatoire pour que la préparation des commandes fonctionne) :

```sh
  make rabbitmq-run
```

⚠️ **Important** : Cette commande doit être lancée pour consommer les messages en file d'attente et ainsi permettre le traitement des commandes de café.

---

### Auteur

Projet développé par Ashad Khan

