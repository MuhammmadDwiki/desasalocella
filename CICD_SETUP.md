# CI/CD Setup Guide

## 📋 Quick Overview

This project uses GitHub Actions for automated CI/CD with:
- ✅ Automated testing before deployment
- ✅ Multi-environment support (dev, staging, production)
- ✅ **Database backup before migrations**
- ✅ Zero-downtime deployments
- ✅ Easy rollback (<30 seconds)

## 🏗️ VPS Setup (One-time)

### 1. Create Directory Structure

```bash
# SSH to your VPS
ssh your-user@your-vps-ip

# Create directories for all environments
sudo mkdir -p /var/www/salocella/{releases,shared/{storage,backups},scripts}
sudo mkdir -p /var/www/salocella-staging/{releases,shared/{storage,backups},scripts}
sudo mkdir -p /var/www/salocella-dev/{releases,shared/{storage,backups},scripts}

# Set permissions
sudo chown -R www-data:www-data /var/www/salocella*
sudo chmod -R 775 /var/www/salocella*/shared
```

### 2. Upload Scripts to VPS

```bash
# From your local machine
scp scripts/*.sh your-user@your-vps:/var/www/salocella/scripts/

# On VPS, make scripts executable
ssh your-user@your-vps
chmod +x /var/www/salocella/scripts/*.sh
```

### 3. Create Environment Files

```bash
# On VPS
sudo nano /var/www/salocella/shared/.env.production
sudo nano /var/www/salocella-staging/shared/.env.staging
sudo nano /var/www/salocella-dev/shared/.env.dev
```

**Important .env variables:**
```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=salocella_prod
DB_USERNAME=root
DB_PASSWORD=your-password
```

### 4. Create Databases

```bash
# On VPS
mysql -u root -p

CREATE DATABASE salocella_prod;
CREATE DATABASE salocella_staging;
CREATE DATABASE salocella_dev;
CREATE DATABASE desasalocella_test;  -- For CI testing
exit;
```

### 5. Update Nginx Configuration

```bash
sudo nano /etc/nginx/sites-available/salocella
```

**Update root path to point to `current/public`:**
```nginx
server {
    server_name salocella.id www.salocella.id;
    root /var/www/salocella/current/public;  # ← Changed!
    
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

```bash
sudo nginx -t
sudo systemctl reload nginx
```

## 🔑 GitHub Secrets Setup

Go to your GitHub repository → Settings → Secrets and variables → Actions

Add these secrets:

```
SSH_HOST        = your-vps-ip
SSH_USER        = your-ssh-username
SSH_KEY         = your-private-key (paste entire key)
SSH_PORT        = 22 (optional, default is 22)
```

**Generate SSH key (if needed):**
```bash
# On your local machine
ssh-keygen -t ed25519 -C "github-actions"
cat ~/.ssh/id_ed25519.pub  # Copy public key to VPS authorized_keys
cat ~/.ssh/id_ed25519      # Copy private key to GitHub Secret SSH_KEY
```

## 🚀 Deployment Workflow

### Dev Environment
```bash
git checkout dev
git add .
git commit -m "feat: new feature"
git push origin dev

# GitHub Actions will:
# 1. Run tests
# 2. Build assets
# 3. Deploy to /var/www/salocella-dev
```

### Staging Environment
```bash
git checkout staging
git merge dev
git push origin staging

# Auto-deploys to /var/www/salocella-staging
```

### Production Environment
```bash
git checkout main
git merge staging
git push origin main

# Requires manual approval in GitHub Actions
# Deploys to /var/www/salocella
```

## 🗄️ Database Backup

### Automatic Backup
Database is **automatically backed up** before every deployment migration:
- Location: `/var/www/salocella/backups/`
- Format: `salocella_prod_YYYYMMDD_HHMMSS.sql.gz`
- Retention: Last 10 backups

### Manual Backup
```bash
ssh your-user@your-vps
cd /var/www/salocella
./scripts/backup-database.sh production
```

### List Backups
```bash
ls -lh /var/www/salocella/backups/
```

## ⏮️ Rollback

### Application Rollback (Quick)
```bash
ssh your-user@your-vps
cd /var/www/salocella
./scripts/rollback.sh production
```

This will:
1. Show current and previous release
2. Ask if you want to rollback database too
3. Switch symlink to previous release
4. Reload PHP-FPM

### Database Rollback (Manual)
```bash
# List available backups
ls -lh /var/www/salocella/backups/

# Restore specific backup
gunzip < /var/www/salocella/backups/salocella_prod_20260204_120000.sql.gz | \
mysql -u root -p salocella_prod
```

## 🧪 Testing the Pipeline

### 1. Test on Dev First
```bash
git checkout dev
echo "// test CI/CD" >> routes/web.php
git add .
git commit -m "test: CI/CD pipeline"
git push origin dev
```

Watch: https://github.com/MuhammmadDwiki/desasalocella/actions

### 2. Verify Deployment
```bash
ssh your-user@your-vps
ls -la /var/www/salocella-dev/current
ls -lh /var/www/salocella-dev/releases/
ls -lh /var/www/salocella-dev/backups/
```

### 3. Test Rollback
```bash
ssh your-user@your-vps
cd /var/www/salocella-dev
./scripts/rollback.sh dev
```

## 📂 Directory Structure

```
/var/www/salocella/
├── releases/
│   ├── 20260204_120000/    ← Previous release
│   ├── 20260204_140000/    ← Latest release
│   └── ...                 (keeps last 5)
├── current → releases/20260204_140000/  ← Symlink (active)
├── shared/
│   ├── storage/            ← Linked to current/storage
│   ├── .env.production     ← Environment config
│   └── backups/
│       ├── salocella_prod_20260204_120000.sql.gz
│       └── ...             (keeps last 10)
└── scripts/
    ├── deploy.sh           ← Deployment script
    ├── rollback.sh         ← Rollback script
    └── backup-database.sh  ← Backup script
```

## 🔍 Health Check

The application includes a health check endpoint:

```bash
curl https://salocella.id/health

# Response:
{
  "status": "healthy",
  "timestamp": "2026-02-04T12:00:00+00:00",
  "database": "connected"
}
```

## ⚠️ Troubleshooting

### Deployment Failed
```bash
# Check GitHub Actions logs
# https://github.com/MuhammmadDwiki/desasalocella/actions

# Check VPS logs
ssh your-user@your-vps
tail -f /var/www/salocella/storage/logs/laravel.log
```

### Rollback Not Working
```bash
# Check available releases
ls /var/www/salocella/releases/

# Check current symlink
readlink /var/www/salocella/current

# Manually switch release
ln -sfn /var/www/salocella/releases/PREVIOUS_RELEASE /var/www/salocella/current
sudo systemctl reload php8.2-fpm
```

### Database Backup Failed
```bash
# Check disk space
df -h

# Check MySQL credentials
mysql -u root -p

# Manual backup
mysqldump -u root -p salocella_prod > backup.sql
```

## 📝 Maintenance

### Clean Old Backups
```bash
# Deployment script keeps last 10 automatically
# Manual cleanup:
cd /var/www/salocella/backups
ls -t *.sql.gz | tail -n +11 | xargs rm -f
```

### Clean Old Releases
```bash
# Deployment script keeps last 5 automatically
# Manual cleanup:
cd /var/www/salocella/releases
ls -t | tail -n +6 | xargs rm -rf
```

## 🎯 Best Practices

1. **Always test on dev** before staging/production
2. **Review GitHub Actions logs** after each deployment
3. **Keep backups** - database backups are automatic but verify they exist
4. **Monitor disk space** - backups and releases consume space
5. **Use staging for final testing** before production
6. **Manual approval for production** - double-check before approving

## 📞 Need Help?

- Check GitHub Actions: https://github.com/MuhammmadDwiki/desasalocella/actions
- Review deployment logs: `/var/www/salocella/storage/logs/`
- Test health endpoint: `curl https://salocella.id/health`
