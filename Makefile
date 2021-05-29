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
	composer exec --verbose phpstan -- --level=8 analyse src tests

test:
	composer exec --verbose phpunit tests

serve:
	php -S localhost:8082

heroku-serve:
	sudo heroku local web

heroku-log:
	heroku logs --tail

apache-kill:
	sudo killAll httpd
