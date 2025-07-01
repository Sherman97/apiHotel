# Usa la imagen oficial de PHP con Apache
FROM php:8.3-apache

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip

# Habilita mod_rewrite de Apache
RUN a2enmod rewrite

# Instala Composer globalmente
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala Node.js (opcional, para compilar assets con Vite o Mix)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos de tu proyecto Laravel al contenedor
COPY . /var/www/html

# Da permisos a la carpeta de almacenamiento y caché
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Instala dependencias de Composer y Node.js
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && npm install && npm run build

# Configura Apache para servir la aplicación Laravel desde la carpeta public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Expone el puerto 80
EXPOSE 80

# Comando por defecto para correr Apache en primer plano
CMD ["apache2-foreground"]