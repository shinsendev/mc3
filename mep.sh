sudo git pull upstream/master
sudo composer install
php bin/console do:mi:mi --no-interaction
sudo php bin/console cache:clear
php bin/console stats:person:update
php bin/console elastic:populate
php bin/console algolia:populate
