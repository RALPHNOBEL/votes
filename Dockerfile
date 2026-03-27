FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
WORKDIR /var/www/html
COPY . .
RUN echo '<Directory /var/www/html>\nAllowOverride All\nRequire all granted\n</Directory>' >> /etc/apache2/apache2.conf
ENV APACHE_RUN_USER=www-data
ENV APACHE_RUN_GROUP=www-data
ENV APACHE_LOG_DIR=/var/log/apache2
ENV PORT=8080
RUN sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf
EXPOSE 8080
CMD ["apache2-foreground"]