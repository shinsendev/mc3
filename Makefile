start:
	symfony server:start

fixtures:
	php bin/console doctrine:fixtures:load

deploy:
	bash mep.sh