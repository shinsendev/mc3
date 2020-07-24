sudo git pull upstream/master
composer install
php bin/console do:mi:mi --no-interaction
php bin/console cache:clear
