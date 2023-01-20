build:
	docker-compose build

up:
	docker-compose up -d

down:
	docker-compose down -v --remove-orphans

migrate:
	docker-compose exec php-fpm bin/console --no-interaction doctrine:migrations:migrate