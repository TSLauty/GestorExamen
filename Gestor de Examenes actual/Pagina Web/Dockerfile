FROM php:8.2-apache

RUN echo "========== APACHE MODULES ==========" \
    && apache2ctl -M \
    && echo "========== MPM FILES ==========" \
    && ls -la /etc/apache2/mods-enabled/ \
    && echo "========== APACHE VERSION ==========" \
    && apache2 -v

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["bash", "-lc", "a2dismod mpm_event mpm_worker 2>/dev/null || true; rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.*; a2enmod mpm_prefork; exec apache2-foreground"]
