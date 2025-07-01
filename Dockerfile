# Usa la imagen oficial de PHP con Apache
FROM php:8.4-apache

# Instala extensiones de PHP necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && a2enmod rewrite

# Copia código
COPY . /var/www/html

# Ajusta permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Genera la APP_KEY
RUN php artisan key:generate --ansi

# Expone el puerto desde Apache
EXPOSE 80

# Arranca Apache en primer plano
CMD ["apache2-foreground"]
