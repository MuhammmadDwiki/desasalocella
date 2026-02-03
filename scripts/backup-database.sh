#!/bin/bash
set -e

ENVIRONMENT=$1
TIMESTAMP=$(date +%Y%m%d_%H%M%S)

if [ -z "$ENVIRONMENT" ]; then
    echo "Usage: ./backup-database.sh [production|staging|dev]"
    exit 1
fi

# =========================================
# ENVIRONMENT CONFIGURATION
# =========================================
if [ "$ENVIRONMENT" = "production" ]; then
    BASE_PATH=/var/www/salocella
    DB_NAME=salocella_prod
elif [ "$ENVIRONMENT" = "staging" ]; then
    BASE_PATH=/var/www/salocella-staging
    DB_NAME=salocella_staging
else
    BASE_PATH=/var/www/salocella-dev
    DB_NAME=salocella_dev
fi

BACKUP_PATH=$BASE_PATH/backups
mkdir -p $BACKUP_PATH

# Load DB credentials from .env
source $BASE_PATH/shared/.env.$ENVIRONMENT
DB_USER=${DB_USERNAME:-root}
DB_PASS=${DB_PASSWORD}

# =========================================
# CREATE BACKUP
# =========================================
echo "📦 Backing up database: $DB_NAME"

mysqldump -u $DB_USER -p$DB_PASS \
    --single-transaction \
    --routines \
    --triggers \
    $DB_NAME > $BACKUP_PATH/${DB_NAME}_${TIMESTAMP}.sql

if [ $? -eq 0 ]; then
    gzip $BACKUP_PATH/${DB_NAME}_${TIMESTAMP}.sql
    
    BACKUP_SIZE=$(du -h $BACKUP_PATH/${DB_NAME}_${TIMESTAMP}.sql.gz | cut -f1)
    echo "✅ Backup created: ${DB_NAME}_${TIMESTAMP}.sql.gz ($BACKUP_SIZE)"
else
    echo "❌ Backup failed!"
    exit 1
fi

# =========================================
# CLEANUP OLD BACKUPS
# =========================================
echo "🧹 Cleaning up old backups (keeping last 10)..."
cd $BACKUP_PATH
ls -t *.sql.gz | tail -n +11 | xargs -r rm -f

echo "✅ Backup complete!"
echo "   Location: $BACKUP_PATH/${DB_NAME}_${TIMESTAMP}.sql.gz"
