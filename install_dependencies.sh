#!/bin/bash

# Install Intervention/Image package for image optimization
composer require intervention/image

# Clear and rebuild caches
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache

# Run the database migration to add indexes
php artisan migrate

# Set proper permissions
chmod -R 775 storage bootstrap/cache
