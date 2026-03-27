FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
RUN rm -f /etc/apache2/mods-enabled/mpm_*.conf /etc/apache2/mods-enabled/mpm_*.load
RUN a2enmod mpm_prefork
WORKDIR /var/www/html
COPY . .
RUN echo '<Directory /var/www/html>\nAllowOverride All\nRequire all granted\n</Directory>' >> /etc/apache2/apache2.conf
ENV PORT=8080
RUN sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf
EXPOSE 8080
CMD ["apache2-foreground"]