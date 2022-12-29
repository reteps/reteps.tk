FROM php:7.4-apache

# Install the required deps
RUN apt-get update --fix-missing
RUN apt-get install -y curl
RUN apt-get install -y build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev
RUN docker-php-ext-configure gd \
    && docker-php-ext-install gd

# Copy the source files
COPY ./src /var/www/html/

# Fix ownership
RUN chown www-data -R /var/www/html/*