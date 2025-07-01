#!/usr/bin/env bash
set -e

# 1) Migraciones y seeders automatizados
php artisan migrate --force
php artisan db:seed --force

# 2) Finalmente arranca Apache
exec apache2-foreground
