APP ?= preformatter
REF_FILE ?= 0001

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
