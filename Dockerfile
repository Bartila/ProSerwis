# Używamy oficjalnego obrazu PHP z Apache
FROM php:8.2-apache

# Instalacja potrzebnych bibliotek
RUN apt-get update && apt-get install -y \
    libzip-dev unzip curl git \
    && docker-php-ext-install pdo pdo_mysql zip

# Instalacja Composera
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Skopiuj pliki Laravel do katalogu serwera
COPY . /var/www/html

# Ustaw katalog roboczy
WORKDIR /var/www/html

# Instalacja zależności Laravel
RUN composer install --no-dev --optimize-autoloader

# Uprawnienia do folderów
RUN chmod -R 755 storage bootstrap/cache \
    && chown -R www-data:www-data .

# Apache – ustawienie katalogu public jako startowego
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Włącz mod_rewrite
RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]
