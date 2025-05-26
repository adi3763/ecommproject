#!/bin/bash
set -e

# Wait for DB if needed (optional, add your own wait logic if required)

# Run Laravel cache commands
php artisan config:cache || true
php artisan route:cache || true

# Run migrations (optional, uncomment if you want)
# php artisan migrate --force || true

# Start Apache
exec "$@"
