#!/bin/bash
set -e

ENVIRONMENT=$1
BRANCH=$2
RELEASE_ID=$(date +%Y%m%d_%H%M%S)

# =========================================
# ENVIRONMENT CONFIGURATION
# =========================================
if [ "$ENVIRONMENT" = "production" ]; then
    BASE_PATH=/var/www/salocella
    ENV_FILE=.env.production
    DB_NAME=desasalo
elif [ "$ENVIRONMENT" = "staging" ]; then
    BASE_PATH=/var/www/salocella-staging
    ENV_FILE=.env.staging
    DB_NAME=salocella_staging
else
    BASE_PATH=/var/www/salocella-dev
    ENV_FILE=.env.dev
    DB_NAME=salocella_dev
fi

RELEASE_PATH=$BASE_PATH/releases/$RELEASE_ID
BACKUP_PATH=$BASE_PATH/backups

echo "🚀 Starting deployment: $ENVIRONMENT (Release: $RELEASE_ID)"

# =========================================
# 0. BACKUP DATABASE (CRITICAL!)
# =========================================
echo "📦 Creating database backup..."
mkdir -p $BACKUP_PATH

# Load DB credentials from current .env
source $BASE_PATH/shared/$ENV_FILE
DB_USER=${DB_USERNAME:-root}
DB_PASS=${DB_PASSWORD}

# Create backup with timestamp
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME > $BACKUP_PATH/${DB_NAME}_${RELEASE_ID}.sql

if [ $? -eq 0 ]; then
    gzip $BACKUP_PATH/${DB_NAME}_${RELEASE_ID}.sql
    echo "✅ Database backed up: ${DB_NAME}_${RELEASE_ID}.sql.gz"
else
    echo "❌ Database backup failed! Aborting deployment."
    exit 1
fi

# Keep only last 10 backups
cd $BACKUP_PATH
ls -t *.sql.gz | tail -n +11 | xargs -r rm -f

# =========================================
# 1. CLONE CODE
# =========================================
echo "📥 Cloning code from $BRANCH branch..."
mkdir -p $RELEASE_PATH
cd /tmp
git clone -b $BRANCH https://github.com/MuhammmadDwiki/desasalocella.git $RELEASE_PATH

# =========================================
# 2. LINK SHARED FILES
# =========================================
echo "🔗 Linking shared files..."
rm -rf $RELEASE_PATH/storage
ln -s $BASE_PATH/shared/storage $RELEASE_PATH/storage
ln -s $BASE_PATH/shared/$ENV_FILE $RELEASE_PATH/.env

# =========================================
# 3. INSTALL DEPENDENCIES
# =========================================
echo "📦 Installing Composer dependencies..."
cd $RELEASE_PATH
composer install --no-dev --optimize-autoloader --no-interaction

# =========================================
# 4. BUILD ASSETS ON SERVER
# =========================================
echo "🎨 Building assets..."
npm ci --silent
npm run build

# =========================================
# 5. RUN MIGRATIONS & SEEDERS
# =========================================
echo "🗄️  Running database migrations..."
php artisan migrate --force

if [ $? -ne 0 ]; then
    echo "❌ Migration failed! Rolling back..."
    # Restore database from backup
    gunzip < $BACKUP_PATH/${DB_NAME}_${RELEASE_ID}.sql.gz | mysql -u $DB_USER -p$DB_PASS $DB_NAME
    echo "✅ Database restored from backup"
    exit 1
fi

echo "👤 Seeding database (creates super admin if not exists)..."
php artisan db:seed --force

# =========================================
# 6. OPTIMIZE APPLICATION
# =========================================
echo "⚡ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan storage:link
php artisan optimize --except=views

# =========================================
# 7. SWITCH SYMLINK (ZERO-DOWNTIME)
# =========================================
echo "🔄 Switching to new release..."
ln -sfn $RELEASE_PATH $BASE_PATH/current

# =========================================
# 8. RELOAD PHP-FPM
# =========================================
echo "🔁 Reloading PHP-FPM..."
sudo systemctl reload php8.2-fpm

# =========================================
# 9. CLEANUP OLD RELEASES
# =========================================
echo "🧹 Cleaning up old releases (keeping last 5)..."
cd $BASE_PATH/releases
ls -t | tail -n +6 | xargs -r rm -rf

# =========================================
# 10. DEPLOYMENT COMPLETE
# =========================================
echo "✅ Deployment complete!"
echo "   Environment: $ENVIRONMENT"
echo "   Release: $RELEASE_ID"
echo "   Path: $RELEASE_PATH"
echo "   Current: $BASE_PATH/current → $RELEASE_PATH"
