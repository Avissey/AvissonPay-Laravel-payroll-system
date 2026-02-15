FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev zip curl ca-certificates \
    libpq-dev  # Ensure libpq-dev is installed for PostgreSQL

# Install PHP extensions (Crucial: pdo_pgsql must be here after libpq-dev)
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql zip

# Install Node.js 18
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Enable Apache rewrite
RUN a2enmod rewrite
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Build Assets
RUN npm install && npm run build

# Run migrations DURING THE BUILD to set up the PostgreSQL database
# This ensures the tables exist before the container ever starts on Render
RUN php artisan migrate --force

# Permissions (Ensure public is included for CSS/JS )
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]