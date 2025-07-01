# Stage único para producción
FROM php:8.4-apache

# 1) Instala extensiones y dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
 && docker-php-ext-install pdo_pgsql \
 && a2enmod rewrite

# 2) Configura directorio de trabajo
WORKDIR /var/www/html

# 3) Copia TODO el código del proyecto
COPY . /var/www/html

# 4) Instala Composer (desde la imagen oficial de Composer)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 5) Ejecuta Composer para instalar dependencias y optimizar
RUN composer install --no-dev --optimize-autoloader

# 6) Genera la APP_KEY
RUN php artisan key:generate --ansi

# 7) Ajusta permisos para storage y cache
RUN chown -R www-data:www-data /var/www/html/storage \
 && chmod -R 775 /var/www/html/storage \
 && chmod -R 775 /var/www/html/bootstrap/cache

# 8) Expone el puerto 80 (Apache)
EXPOSE 80

# 9) Arranca Apache en primer plano
CMD ["apache2-foreground"]
