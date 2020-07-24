sudo git pull upstream/master
sudo composer install
php bin/console do:mi:mi --no-interaction
sudo php bin/console cache:clear
