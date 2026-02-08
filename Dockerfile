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

# Prepare storage and database
# We create the database file here during build to ensure it exists
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views database && \
    touch database/database.sqlite && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache database

# Set the PORT environment variable for Apache (Render requirement )
ENV PORT=80
EXPOSE 80

# Start Apache directly
CMD ["apache2-foreground"]
