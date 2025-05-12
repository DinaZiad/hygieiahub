#!/bin/bash

# Run only the alternative migration
php artisan migrate --path=database/migrations/2025_05_13_000001_add_indexes_alternative.php

# Clear and rebuild caches
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache
