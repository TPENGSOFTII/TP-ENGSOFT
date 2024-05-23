setup:
	@make build
	@make up
	@make composer-update
	@make permission
build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
composer-update:
	docker exec teste-multipedidos bash -c "composer update"
data:
	docker exec teste-multipedidos bash -c "php artisan migrate"
	docker exec teste-multipedidos bash -c "php artisan db:seed"
permission:
	docker exec teste-multipedidos bash -c "chmod -R 777 storage/ && chmod -R guo+w storage && chmod -R gu+w storage && chgrp -R www-data storage bootstrap/cache && chmod -R ug+rwx storage bootstrap/cache"
generate-key:
	docker exec teste-multipedidos bash -c "php artisan key:generate"
test:
	docker exec teste-multipedidos bash -c "php artisan test"