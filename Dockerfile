FROM php:8.4-apache

# Instala extensiones
RUN apt-get update && apt-get install -y libpq-dev unzip \
 && docker-php-ext-install pdo_pgsql

WORKDIR /var/www/html

# Copia el código
COPY . /var/www/html

# Instala Composer y dependencias
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader \
 && php artisan key:generate --ansi

# Ajusta DocumentRoot y .htaccess
RUN sed -ri 's!DocumentRoot /var/www/html!DocumentRoot /var/www/html/public!g' \
    /etc/apache2/sites-available/*.conf \
 && sed -ri 's!AllowOverride None!AllowOverride All!g' \
    /etc/apache2/apache2.conf \
 && a2enmod rewrite

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]
