up: ## Build and start the containers
	docker compose -f ./docker-compose.yml up -d --build

down: ## Stop containers
	docker compose -f ./docker-compose.yml down

install_backend:
	docker exec -u dev -it coffreo_backend composer install

install_frontend:
	docker exec -it coffreo_frontend npm install

coffreo_backend:
	docker exec -u dev -it coffreo_backend bash

coffreo_frontend:
	docker exec -it coffreo_frontend sh