#!/bin/bash

# Script to update robots.txt with actual APP_URL from .env file

# Read APP_URL from .env file
APP_URL=$(grep "^APP_URL=" .env | cut -d '=' -f2-)

# Remove any quotes from APP_URL
APP_URL=$(echo "$APP_URL" | tr -d '"' | tr -d "'")

# Update robots.txt
sed -i "s|APP_URL_PLACEHOLDER|$APP_URL|g" public/robots.txt

echo "robots.txt updated successfully with APP_URL: $APP_URL"
