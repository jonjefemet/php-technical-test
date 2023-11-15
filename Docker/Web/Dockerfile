# Use the official Composer image as the base image
FROM composer:latest AS composer

# Set the working directory
WORKDIR /app

# Copy the `composer.json` and `composer.lock` files
COPY composer.json /app/

# Install the dependencies
RUN composer install

RUN composer dump-autoload

# Use the official PHP image as the base image
FROM php:8.2-apache

# Copy the dependencies from the Composer image
COPY --from=composer /app/vendor/ /var/www/html/vendor/

# Copy the rest of the application
COPY . /var/www/html/

# Change the permissions of the files
RUN chmod -R 777 /var/www/html/

# Expose port 80
EXPOSE 80

RUN a2enmod rewrite

# Start Apache in the foreground
CMD ["apache2-foreground"]