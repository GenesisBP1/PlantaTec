FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    sqlite3 \
    libsqlite3-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_sqlite pdo_pgsql mbstring zip exif pcntl bcmath gd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

RUN mkdir -p /var/data /var/www/html/database \
    && touch /var/www/html/database/database.sqlite \
    && touch /var/data/database.sqlite \
    && chown -R www-data:www-data /var/www/html/database /var/data storage bootstrap/cache

# Avoid caching configuration at build time so runtime env vars (APP_KEY, DB_*) are respected.
# Caching config during image build can bake empty APP_KEY into the cache and cause HTTP 500.
#RUN php artisan optimize || true

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]