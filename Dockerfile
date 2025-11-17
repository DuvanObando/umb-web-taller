# Usar una imagen oficial de PHP con Apache
FROM php:8.2-apache

WORKDIR /var/www/html

# Copiar los archivos de la API al directorio web del servidor
COPY backend/api/ .

# Habilitar mod_rewrite, permitir .htaccess y habilitar mysqli
RUN a2enmod rewrite \
    && sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

RUN docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli
