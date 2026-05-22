#!/bin/bash
set -e

# Ensure permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database || true

# Wait for database file if using sqlite
if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
  DB_FILE=${DB_DATABASE:-/var/www/html/database/database.sqlite}
  mkdir -p "$(dirname "$DB_FILE")"
  touch "$DB_FILE"
  chown www-data:www-data "$DB_FILE" || true
fi

# Run migrations and seeders once at startup if enabled
if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
  if command -v php >/dev/null 2>&1; then
    echo "Running migrations..."
    php artisan migrate --force || true
    echo "Seeding database..."
    php artisan db:seed --force || true
  fi
fi

# Exec the container CMD
exec "$@"
