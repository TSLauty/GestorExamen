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

CMD ["apache2-foreground"]
