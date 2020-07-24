sudo git pull upstream master
sudo composer install
php bin/console do:mi:mi --no-interaction
sudo php bin/console cache:clear
sudo php bin/console stats:person:update
sudo php bin/console elastic:populate
sudo php bin/console algolia:populate
