test:
	docker compose exec -u root catapult_console bash -c "./vendor/bin/simple-phpunit --colors tests"
ssh:
	docker compose exec -u root catapult_console bash -l