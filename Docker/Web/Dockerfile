# Use the official PHP image as the base image
FROM php:8.3-apache


RUN if ! [ -x "$(command -v composer)" ]; then curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; fi

RUN apt-get update && apt-get install -y \
    libssl-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && docker-php-ext-install zip

RUN echo "extension=mongodb.so" >> /usr/local/etc/php/php.ini

ENV COMPOSER_ALLOW_SUPERUSER 1

# Copy the rest of the application
COPY . /var/www/html/

# Copy the dependencies from the Composer image
RUN composer install

RUN composer dump-autoload

# Change the permissions of the files
RUN chmod -R 777 /var/www/html/

# Expose port 80
EXPOSE 80

RUN a2enmod rewrite

# Start Apache in the foreground
CMD ["apache2-foreground"]