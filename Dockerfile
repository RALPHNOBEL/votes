FROM debian:bookworm-slim

RUN apt-get update && apt-get install -y \
    apache2 \
    php8.2 \
    php8.2-mysql \
    php8.2-pdo \
    libapache2-mod-php8.2 \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite php8.2

WORKDIR /var/www/html
COPY . .

RUN chown -R www-data:www-data /var/www/html

RUN echo '<Directory /var/www/html>\nAllowOverride All\nRequire all granted\n</Directory>' >> /etc/apache2/apache2.conf

ENV PORT=8080
RUN sed -i "s/80/8080/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 8080
CMD ["apache2ctl", "-D", "FOREGROUND"]