FROM php:8.4-apache

# Add composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Add PHP extension installer helper
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Install system dependencies
RUN apt-get update &&\
    apt-get install -y git unzip &&\
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install GD PHP Extension
RUN install-php-extensions gd intl zip

# Enable support for .htacces files
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

# Enable mode_rewrite and mod_headers
RUN a2enmod rewrite headers

# Set UID of web server user to the same as the user on the host maching
# This enables the webserver to create and write files, e.g. sessions.
RUN usermod -u 1000 www-data
