#!/usr/bin/env bash

echo "Running deployment script..."

( php artisan migrate --force )

echo "Deployment script finished."