FROM php:8.1-apache

RUN apt-get update && \
    apt-get install -y libicu-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl pdo pdo_mysql

# Copiez les fichiers de l'application dans le conteneur
COPY . /var/www/html/

# Assurez-vous que l'utilisateur www-data a les bonnes permissions
RUN chown -R www-data:www-data /var/www/html
