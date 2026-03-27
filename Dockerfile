FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
RUN a2dismod mpm_event mpm_worker 2>/dev/null || true
RUN a2enmod mpm_prefork
RUN echo "display_errors = On\nerror_reporting = E_ALL" > /usr/local/etc/php/conf.d/errors.ini
WORKDIR /var/www/html
COPY . .
RUN echo '<Directory /var/www/html>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf
EXPOSE 8080
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
CMD ["apache2-foreground"]