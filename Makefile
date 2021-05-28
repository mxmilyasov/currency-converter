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
