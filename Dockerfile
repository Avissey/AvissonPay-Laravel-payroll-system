FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    ca-certificates \
    libpq-dev  # Required for PostgreSQL

# Install Node.js 18
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql zip # Added pdo_pgsql

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
# Run migrations DURING THE BUILD to set up the PostgreSQL database
# This ensures the tables exist before the container ever starts on Render
RUN php artisan migrate --force

# Set final permissions for storage, cache, and public directories
# Removed SQLite-specific database permissions and ensured public is included
RUN chown -R www-data:www-data storage bootstrap/cache public && \
    chmod -R 775 storage bootstrap/cache

EXPOSE 80

# Start Apache immediately
CMD ["apache2-foreground"]