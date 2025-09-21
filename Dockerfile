# Imagen base con PHP y Composer
FROM php:8.2-cli

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y unzip git libpq-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configurar directorio de la app
WORKDIR /app

# Copiar archivos
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Exponer el puerto (Render usará $PORT)
EXPOSE 8080

# Comando para correr Laravel
CMD php artisan serve --host 0.0.0.0 --port 8080
