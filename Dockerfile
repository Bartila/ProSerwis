FROM php:8.2-fpm

# Zainstaluj wymagane rozszerzenia
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Ustaw katalog roboczy
WORKDIR /var/www

# Skopiuj pliki projektu
COPY . .

# Instalacja zależności przez Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Ustaw uprawnienia
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache
