FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
WORKDIR /var/www/html
COPY . .
RUN echo '<Directory /var/www/html>\nAllowOverride All\nRequire all granted\n</Directory>' >> /etc/apache2/apache2.conf
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf
RUN sed -i 's/:80>/:${PORT}>/' /etc/apache2/sites-available/000-default.conf
ENV PORT=8080
EXPOSE 8080
CMD ["apache2-foreground"]