FROM php:8.2-apache

# Zainstaluj potrzebne pakiety
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Włącz mod_rewrite (potrzebny dla Laravel)
RUN a2enmod rewrite

# Ustaw katalog roboczy
WORKDIR /var/www/html

# Skopiuj pliki projektu do kontenera
COPY . /var/www/html

# Ustaw poprawnie root Apache (na public/)
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Zainstaluj Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instaluj zależności Laravel
RUN composer install --no-dev --optimize-autoloader

# Wyczyść i przebuduj konfigurację Laravel
RUN php artisan config:clear && php artisan config:cache

# Ustaw uprawnienia do storage i cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Wystaw port HTTP
EXPOSE 80
