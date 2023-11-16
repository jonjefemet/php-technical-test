run-dev:
	@echo "Starting all services..."
	@docker-compose up

build:
	@echo "Starting the container..."
	@docker start php-technical-test-web
	@echo "Installing composer dependencies..."
	@ls
	@docker exec php-technical-test-web composer update
	$(MAKE) copy-vendor
	@echo "Stopping the container..."
	@docker stop php-technical-test-web

copy-vendor:
	@echo "Copying vendor files..."
	@docker cp php-technical-test-web:/var/www/html/vendor ./
	@echo "Done."