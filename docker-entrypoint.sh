#!/bin/bash
set -e

PORT="${PORT:-80}"

# Point Apache at Railway's dynamic PORT
sed -i "s/Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:.*>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-enabled/000-default.conf

exec apache2-foreground