install:
	composer install

update:
	composer update

autoload:
	composer dumpautoload

validate:
	composer validate

lint:
	composer run-script phpcs -- --standard=PSR12 src
	composer exec --verbose phpstan -- --level=8 analyse src

test:
	composer exec --verbose phpunit tests

serve:
	php -S localhost:8082 -t public/

heroku-serve:
	sudo heroku local web

heroku-log:
	heroku logs --tail

apache-kill:
	sudo killAll httpd

db-update:
	vendor/bin/doctrine orm:schema-tool:update --force
