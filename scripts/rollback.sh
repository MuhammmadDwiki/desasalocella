#!/bin/bash
set -e

ENVIRONMENT=$1

if [ -z "$ENVIRONMENT" ]; then
    echo "Usage: ./rollback.sh [production|staging|dev]"
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

echo "⏮️  Rolling back $ENVIRONMENT environment..."

# =========================================
# FIND PREVIOUS RELEASE
# =========================================
CURRENT=$(readlink $BASE_PATH/current)
CURRENT_RELEASE=$(basename $CURRENT)

PREVIOUS=$(ls -t $BASE_PATH/releases | grep -v $CURRENT_RELEASE | head -n 1)

if [ -z "$PREVIOUS" ]; then
    echo "❌ No previous release found to rollback to"
    exit 1
fi

PREVIOUS_PATH=$BASE_PATH/releases/$PREVIOUS

echo "Current release: $CURRENT_RELEASE"
echo "Rolling back to: $PREVIOUS"

# =========================================
# OPTIONAL: ROLLBACK DATABASE
# =========================================
read -p "Do you want to rollback the database as well? (y/N): " ROLLBACK_DB

if [ "$ROLLBACK_DB" = "y" ] || [ "$ROLLBACK_DB" = "Y" ]; then
    BACKUP_FILE=$(ls -t $BASE_PATH/backups/${DB_NAME}_${PREVIOUS}*.sql.gz 2>/dev/null | head -n 1)
    
    if [ -z "$BACKUP_FILE" ]; then
        echo "⚠️  No matching database backup found for release $PREVIOUS"
        echo "Available backups:"
        ls -lh $BASE_PATH/backups/*.sql.gz | tail -n 5
        read -p "Enter backup filename to restore (or press Enter to skip): " MANUAL_BACKUP
        
        if [ -n "$MANUAL_BACKUP" ]; then
            BACKUP_FILE=$BASE_PATH/backups/$MANUAL_BACKUP
        fi
    fi
    
    if [ -n "$BACKUP_FILE" ]; then
        echo "📦 Restoring database from: $(basename $BACKUP_FILE)"
        
        # Load DB credentials
        source $BASE_PATH/shared/.env.$ENVIRONMENT
        DB_USER=${DB_USERNAME:-root}
        DB_PASS=${DB_PASSWORD}
        
        # Create safety backup before restore
        SAFETY_BACKUP=$BASE_PATH/backups/${DB_NAME}_before_rollback_$(date +%Y%m%d_%H%M%S).sql.gz
        echo "Creating safety backup first..."
        mysqldump -u $DB_USER -p$DB_PASS $DB_NAME | gzip > $SAFETY_BACKUP
        
        # Restore
        gunzip < $BACKUP_FILE | mysql -u $DB_USER -p$DB_PASS $DB_NAME
        echo "✅ Database restored"
    fi
fi

# =========================================
# SWITCH SYMLINK TO PREVIOUS RELEASE
# =========================================
echo "🔄 Switching symlink to previous release..."
ln -sfn $PREVIOUS_PATH $BASE_PATH/current

# =========================================
# RELOAD PHP-FPM
# =========================================
echo "🔁 Reloading PHP-FPM..."
sudo systemctl reload php8.2-fpm

# =========================================
# CLEAR CACHE
# =========================================
echo "🧹 Clearing application cache..."
cd $BASE_PATH/current
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# =========================================
# ROLLBACK COMPLETE
# =========================================
echo ""
echo "✅ Rollback complete!"
echo "   Environment: $ENVIRONMENT"
echo "   Previous release: $CURRENT_RELEASE"
echo "   Current release: $PREVIOUS"
echo "   Path: $BASE_PATH/current → $PREVIOUS_PATH"
echo ""
echo "⚠️  The failed release ($CURRENT_RELEASE) is still in $BASE_PATH/releases/"
echo "   You can delete it manually if needed."
