#!/bin/sh

# Exit on error
set -e

echo "Starting PHP-FPM..."
php-fpm -D

# Wait for PHP-FPM to be ready
sleep 2

echo "Starting Nginx..."
nginx -g 'daemon off;'
