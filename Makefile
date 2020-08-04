start:
	symfony server:start

fixtures:
	php bin/console doctrine:fixtures:load

stats:
	php bin/console stats:person:update

deploy:
	bash mep.sh

