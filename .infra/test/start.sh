export PROJECT_IMAGE=laravel_php-fpm:latest;
export COMPOSER=composer:1.9.3;
docker-compose -p test-laravel -f docker-compose.yml -f docker-compose.local.yml up