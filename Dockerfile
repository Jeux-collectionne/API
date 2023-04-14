# Utilisez une image de PHP comme base
FROM php:8.2.4-apache

# Définit le répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Changement du fichier racine dans apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Installation de xDebug
# RUN pecl install redis \
# 	&& pecl install xdebug-2.8.1 \
# 	&& docker-php-ext-enable redis xdebug

# Installez les extensions PHP nécessaires pour Symfony
RUN docker-php-ext-install pdo pdo_mysql

# Exposez le port 80 pour accéder à l'application
ARG PORT=80
EXPOSE $PORT

# Copiez les fichiers du projet dans le conteneur
COPY . /var/www/html

# Installez les dépendances du projet à l'aide de composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# RUN composer install --no-dev --optimize-autoloader
