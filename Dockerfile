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
    nodejs # Node.js is now installed via nodesource, but keep this for general dependencies

# Install Node.js 18 (REQUIRED for Tailwind v4) - Using official NodeSource script
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

# Copy project files - This should happen BEFORE composer/npm install to ensure all files are present
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Install JS deps & build Tailwind
RUN npm install
RUN npm run build

# Set correct permissions for storage, cache, and public directories
RUN chown -R www-data:www-data storage bootstrap/cache public

# Create the database directory and file
RUN mkdir -p /var/www/html/database && \
    touch /var/www/html/database/database.sqlite

# Set permissions for the entire app and the database
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Run migrations during the build (to prepare the schema)
# Note: This creates the tables in the image itself
RUN php artisan migrate --force

EXPOSE 80
CMD [
"apache2-foreground"]