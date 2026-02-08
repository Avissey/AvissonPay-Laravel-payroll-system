FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev zip curl ca-certificates

# Install Node.js 18
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy custom Apache configuration
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Install JS deps & build Tailwind
RUN npm install && npm run build

# --- DATABASE & PERMISSIONS SETUP ---
# 1. Create the database file
RUN mkdir -p database storage/framework/cache storage/framework/sessions storage/framework/views && \
    touch database/database.sqlite

# 2. Run migrations DURING THE BUILD
# This ensures the tables exist before the container ever starts on Render
RUN php artisan migrate --force

# 3. Set final permissions
# We do this AFTER migrations so the file is already there
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache database

EXPOSE 80

# Start Apache immediately (no extra commands to slow it down )
CMD ["apache2-foreground"]
