stan:
	@echo "Running PHPStan analysis..."
	php vendor/bin/phpstan analyse -l max src tests

coverage:
	@echo "Running PHPUnit with coverage..."
	docker-compose exec php-fpm ./vendor/bin/phpunit --coverage-html var/code-coverage

unit:
	@echo "Running PHPUnit tests..."
	docker-compose exec php-fpm ./vendor/bin/phpunit tests

up:
	@echo "Building Docker images..."
	docker-compose build
	@echo "Starting Docker containers..."
	docker-compose up -d

stop:
	@echo "Stopping Docker containers..."
	docker-compose stop