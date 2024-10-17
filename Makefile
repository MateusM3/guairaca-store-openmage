COMMANDS := composer app
ifneq (filter $(COMMANDS),$(firstword $(MAKECMDGOALS)))
COMMANDS_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
$(eval $(COMMANDS_ARGS):;@:)
endif

.PHONY: composer
composer:
	mkdir -p ~/.cache/composer/files ~/.cache/composer/repo
	docker run --rm -it -u $(shell id -u):$(shell id -g) -v ~/.cache/composer/:/tmp/cache/ -v $(shell pwd):/app composer $(COMMANDS_ARGS) --ignore-platform-reqs

.PHONY: app
app:
	docker-compose exec app $(COMMANDS_ARGS)

.PHONY: webserver
webserver:
	docker-compose exec webserver sh

.PHONY: database
database:
	docker-compose exec database mysql -u root -p

.PHONY: app-logs
app-logs:
	docker-compose logs app

.PHONY: webserver-logs
webserver-logs:
	docker-compose logs webserver

.PHONY: database-logs
logs:
	docker-compose logs database

.PHONY: start
start:
	docker-compose start

.PHONY: stop
stop:
	docker-compose stop

.PHONY: restart
restart:
	docker-compose restart

.PHONY: up
up:
	docker-compose up -d

.PHONY: down
down:
	docker-compose down

.PHONY: add-host
add-host:
	sudo ./.docker/add-hosts $(COMMANDS_ARGS)