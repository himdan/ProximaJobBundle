up:
	docker compose up -d
test:
	docker compose exec -u root catapult_console bash -c "./vendor/bin/simple-phpunit --colors tests"
ssh:
	docker compose exec -u root catapult_console bash -l

messenger:
	docker compose exec -u root catapult_console bash -c "bin/console messenger:consume -vv --env=test"

clean:
	docker compose  down --remove-orphans --volumes

schema_update_test:
	docker compose exec -u root catapult_console bash -c "bin/console d:s:u --force --env=test"

schema_update_dev:
	docker compose exec -u root catapult_console bash -c "bin/console d:s:u --force --env=test"
