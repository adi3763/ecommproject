FROM php:8.2-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Set Apache document root to /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update Apache config to use the new document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy Laravel app files
COPY . .

# Ensure .env exists
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Install PHP dependencies (this creates the vendor/ folder)
RUN composer install --no-dev --optimize-autoloader

# Generate Laravel application key
RUN php artisan key:generate

# Optimize Laravel caches (optional but recommended)
RUN php artisan config:cache && php artisan route:cache

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Ensure uploads/photos directory exists and is writable
RUN mkdir -p public/uploads/photos && chown -R www-data:www-data public/uploads && chmod -R 775 public/uploads

EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
