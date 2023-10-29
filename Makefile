include docker/.env

PHP_SERVICE=php
COMPOSE_FILE=docker/docker-compose.yml
ENV_FILE=docker/.env

install: up-containers copy-env composer-install key-generate migrate ## Install project
restart: stop start ## Restart all started containers
start: start-containers copy-env composer-install clear-cache migrate ## Start all containers
stop: stop-containers ## Stop all started containers

up-containers: ## Start containers (php, mysql, nginx, ...)
	docker-compose --env-file ./docker/.env -f ./docker/docker-compose.yml up --force-recreate -d
start-containers: ## Start all containers
	docker-compose --env-file ./docker/.env -f ./docker/docker-compose.yml start
stop-containers: ## Stop all containers
	docker-compose --env-file ./docker/.env -f ./docker/docker-compose.yml stop

copy-env: ## Copies env
	docker-compose --env-file ./docker/.env -f ./docker/docker-compose.yml exec -T php cp -n ./.env.example ./.env
composer-install: ## Run composer install command
	docker-compose --env-file ./docker/.env -f ./docker/docker-compose.yml exec -T php composer install
key-generate: ## Run artisan key generate command
	docker-compose --env-file ./docker/.env -f ./docker/docker-compose.yml exec -T php php artisan key:generate
migrate: ## Run artisan migrate command
	docker-compose --env-file ./docker/.env -f ./docker/docker-compose.yml exec -T php php artisan migrate --force
terminal: ## Start terminal in interactive mode
    docker-compose --env-file ./docker/.env -f ./docker/docker-compose.yml exec php bash
clear-cache: ## Run artisan clear cache commands
	docker-compose --env-file ./docker/.env -f ./docker/docker-compose.yml exec -T php php artisan cache:clear
	docker-compose --env-file ./docker/.env -f ./docker/docker-compose.yml exec -T php php artisan config:clear
	docker-compose --env-file ./docker/.env -f ./docker/docker-compose.yml exec -T php php artisan view:clear
	docker-compose --env-file ./docker/.env -f ./docker/docker-compose.yml exec -T php php artisan route:clear
start-Dockerfile-cli:
	docker run --rm -it -v stripe-config://root/.config/stripe/ -v stripe-gpg://root/.gnupg/ -v stripe-pass://root/.password-store/ stripe-cli customers list --api-key sk_test_51O4SapGFQvdPANt6mBlJECyUbs3PukUTjfTqcwT5t7TrTheUEtd6zQDhQBhIMkbU5YP44fGSUaqgkVNQ1W9qqNtl001xmFZRw7
	docker run --rm -it -v stripe-config://root/.config/stripe/ -v stripe-gpg://root/.gnupg/ -v stripe-pass://root/.password-store/ stripe-cli $stripe listen --forward-to host.docker.internal:8000/webhook/stripe
