console c:
	docker-compose -f docker-compose.yml exec php sh

build b:
	docker-compose up --build

start s:
	docker-compose up -d

stop:
	docker-compose stop

ps:
	docker-compose ps

stop-all k:
	sudo service apache2 stop & sudo service postgresql stop

log logs l:
	docker-compose logs -f

prune-all prune:
	docker system prune -a

make create-db cdb:
	docker-compose -f docker-compose.yml exec php php bin/console do:da:cr

fixtures f:
	docker-compose -f docker-compose.yml exec php php bin/console doctrine:fixtures:load

stats:
	docker-compose -f docker-compose.yml exec php php bin/console stats:person:update

deploy:
	bash mep.sh

test t:
	docker-compose -f docker-compose.yml exec php bin/phpunit
