FROM php:8.2-apache

# Désactiver les MPM en conflit et activer le bon
RUN a2dismod mpm_event mpm_worker 2>/dev/null || true \
    && a2enmod mpm_prefork rewrite

# Installer les extensions PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copier les fichiers du projet
COPY . /var/www/html/

# Permissions
RUN chmod -R 755 /var/www/html/

EXPOSE 80