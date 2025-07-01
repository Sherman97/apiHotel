# 1. Base de PHP + Apache
FROM php:8.4-apache

# 2. Instala extensiones necesarias y habilita mod_rewrite
RUN apt-get update \
 && apt-get install -y libpq-dev unzip \
 && docker-php-ext-install pdo_pgsql \
 && a2enmod rewrite

# 3. Establece el directorio de trabajo
WORKDIR /var/www/html

# 4. Copia todo el código de tu proyecto
COPY . /var/www/html

# 5. Copia Composer desde su imagen oficial e instala dependencias
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 6. Prepara el .env y genera la APP_KEY
RUN cp .env.example .env \
 && php artisan key:generate --ansi

# 7. Ajusta DocumentRoot a public/ y permite .htaccess
RUN sed -ri 's!DocumentRoot /var/www/html!DocumentRoot /var/www/html/public!g' /etc/apache2/sites-available/*.conf \
 && sed -ri 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf

# 8) Copia el script de arranque y dale permisos
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# 9. Ajusta permisos para storage y cache
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# 10. Expone el puerto 80 y arranca Apache
EXPOSE 80
CMD ["apache2-foreground"]
