docker run --rm --interactive --tty \
--volume $PWD/../..:/app \
--user $(id -u):$(id -g) \
composer:2.3.5 /bin/bash -c "composer dump-autoload --no-scripts"