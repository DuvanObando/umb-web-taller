# Usar una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Copiar los archivos de la API al directorio web del servidor
COPY api/ /var/www/html/

# Habilitar mod_rewrite para URLs amigables
RUN a2enmod rewrite
