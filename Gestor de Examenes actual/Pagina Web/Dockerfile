FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Disable conflicting Apache MPM modules, keeping only mpm_event enabled.
# The php:8.2-apache image ships with mpm_prefork and mpm_worker enabled
# by default, which causes "More than one MPM loaded" errors on startup.
RUN a2dismod mpm_prefork mpm_worker && a2enmod mpm_event

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
