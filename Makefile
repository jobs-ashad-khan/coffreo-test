up: ## Build and start the containers
	docker compose -f ./docker-compose.yml up -d --build

down: ## Stop containers
	docker compose -f ./docker-compose.yml down

install_backend:
	docker exec -u dev -it coffreo_backend composer install

db_migrations:
	docker exec -u dev -it coffreo_backend bin/console doctrine:migrations:migrate --no-interaction

db_fixtures:
	docker exec -u dev -it coffreo_backend bin/console doctrine:fixtures:load --no-interaction

install_frontend:
	docker exec -it coffreo_frontend npm install

coffreo_backend:
	docker exec -u dev -it coffreo_backend bash

coffreo_frontend:
	docker exec -u node -it coffreo_frontend sh

coffreo_db:
	docker exec -it coffreo_db bash

coffreo_rabbitmq:
	docker exec -u dev -it coffreo_backend bin/console messenger:consume async -vv

log-nginx:
	docker logs -f coffreo_nginx

log-backend:
	docker logs -f coffreo_backend

log-rabbitmq:
	docker logs -f coffreo_rabbitmq

log-mercure:
	docker logs -f coffreo_mercure