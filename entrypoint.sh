#!/bin/bash

# Ensure the database directory exists
mkdir -p /var/www/html/database

# Create the database file if it doesn't exist
touch /var/www/html/database/database.sqlite

# Set permissions so Apache (www-data) can write to it
chown -R www-data:www-data /var/www/html/database
chmod -R 775 /var/www/html/database

# Run migrations to create the tables
php artisan migrate --force

# Start Apache
exec apache2-foreground
