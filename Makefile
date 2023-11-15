copy-vendor:
	@echo "Copying vendor files..."
	docker cp php-technical-test-web:/var/www/html/vendor ./
	@echo "Done."