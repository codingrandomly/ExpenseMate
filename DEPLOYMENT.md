# Deployment Guide for ExpenseMate

This guide provides step-by-step instructions for deploying ExpenseMate to various platforms.

## Quick Deploy Options

### Option 1: Railway (Recommended - Easiest) ⭐

Railway is the easiest option for deploying PHP applications. It automatically detects and configures PHP.

#### Steps:

1. **Go to Railway.app**
   - Visit https://railway.app
   - Sign up/Login with GitHub

2. **Create New Project**
   - Click "Create New Project"
   - Select "Deploy from GitHub"
   - Choose the `codingrandomly/ExpenseMate` repository

3. **Configure**
   - Railway will auto-detect the PHP project
   - Click "Deploy"
   - Wait for deployment to complete (~2-3 minutes)

4. **Access Your App**
   - Once deployed, you'll get a URL like: `https://expensemate-xxx.railway.app`
   - Open it and start using ExpenseMate!

**Pros:**
- Zero configuration needed
- Free tier available
- Automatic HTTPS
- Persistent data (CSV files persist)
- Easy rollback

---

### Option 2: Heroku

Heroku is a popular Platform as a Service (PaaS).

#### Prerequisites:
```bash
# Install Heroku CLI
curl https://cli-assets.heroku.com/install.sh | sh

# Login to Heroku
heroku login
```

#### Steps:

1. **Create Heroku App**
   ```bash
   heroku create expensemate-app
   ```

2. **Build and Deploy**
   ```bash
   git push heroku main
   ```

3. **Open App**
   ```bash
   heroku open
   ```

4. **View Logs**
   ```bash
   heroku logs --tail
   ```

**Notes:**
- Heroku's free tier has been discontinued (paid plans start at $7/month)
- Data persists on Heroku's ephemeral filesystem temporarily
- For permanent storage, consider Heroku Postgres (add-on)

---

### Option 3: Render

Render is a modern cloud platform similar to Railway.

#### Steps:

1. **Go to Render.com**
   - Visit https://render.com
   - Sign up with GitHub

2. **Create New Service**
   - Click "New +"
   - Select "Web Service"
   - Connect your GitHub repository

3. **Configure**
   - **Build Command**: Leave empty (Render auto-detects)
   - **Start Command**: `php -S 0.0.0.0:8080`
   - **Instance Type**: Free (or paid for persistence)

4. **Deploy**
   - Click "Create Web Service"
   - Wait for deployment

**Pros:**
- Free tier available
- Good documentation
- Reliable uptime

---

### Option 4: Vercel (with Serverless Functions)

Vercel is best for static sites but can run PHP with serverless functions (requires restructuring).

#### Pros:
- Extremely fast (CDN)
- Easy GitHub integration
- Free tier generous

#### Cons:
- Requires restructuring for serverless PHP
- Not ideal for traditional PHP apps like ExpenseMate

**Not recommended** for this project due to architectural differences.

---

### Option 5: Traditional VPS/Hosting

If you have access to traditional web hosting:

#### Steps:

1. **Connect via SSH**
   ```bash
   ssh user@your-server.com
   ```

2. **Clone Repository**
   ```bash
   cd /var/www
   git clone https://github.com/codingrandomly/ExpenseMate.git
   ```

3. **Configure Web Server**
   - For Apache: Create `.htaccess` in root
   - For Nginx: Configure server block

4. **Set Permissions**
   ```bash
   chmod -R 755 /var/www/ExpenseMate
   chmod -R 777 /var/www/ExpenseMate  # Data directory
   ```

5. **Access via Domain**
   - Visit `https://yourdomain.com`

---

## Data Persistence

### Important Note about CSV Storage

ExpenseMate uses CSV files (`expenses.csv`) to store data. Different platforms handle file storage differently:

#### Railway ✅
- **Persistent**: YES
- CSV files persist across deployments
- Recommended for this project

#### Heroku ⚠️
- **Persistent**: NO (with caveat)
- Heroku uses ephemeral filesystem
- Data deleted on dyno restart (~24 hours)
- **Solution**: Add Heroku Postgres add-on (paid)

#### Render ✅
- **Persistent**: YES (with Persistent Disk)
- Need to configure persistent disk mount
- Free tier: Limited storage

#### Traditional Hosting ✅
- **Persistent**: YES
- All data stored permanently
- Recommended for production

---

## Configuration for Deployment

### Railway Deployment Details

The repository includes these deployment files:

1. **Procfile**
   ```
   web: php -S 0.0.0.0:${PORT:-8000}
   ```
   - Tells Railway how to start the app
   - Uses dynamic PORT environment variable

2. **runtime.txt**
   ```
   php-8.3
   ```
   - Specifies PHP 8.3 (latest supported version)

3. **composer.json**
   - Defines PHP dependencies
   - Enables Composer integration

### Environment Variables

No environment variables required for basic deployment!

Optional for advanced use:
```bash
# Example (if needed in future)
ENVIRONMENT=production
DEBUG=false
```

---

## Monitoring & Logs

### Railway
- Dashboard at railway.app
- Real-time logs
- Deployment history
- Metrics

### Heroku
```bash
heroku logs --tail
heroku ps
heroku config
```

### Render
- Dashboard at render.com
- Real-time logs
- Resource usage graphs

---

## Troubleshooting

### Issue: 500 Error on Deployment

**Solution:**
```bash
# Check logs
railway logs  # or heroku logs --tail

# Check PHP version compatibility
# Ensure PHP 8.0+
```

### Issue: CSV File Not Updating

**Solution:**
- Ensure write permissions on `/var/www` directory
- Check if platform supports persistent storage
- For ephemeral filesystems (Heroku), migrate to database

### Issue: Slow Performance

**Solution:**
- Upgrade to paid tier
- Add caching layer
- Optimize CSV file size (archive old data)

---

## Migration to Database (Optional)

If you want persistent data with better performance, migrate to a database:

1. **Add Database Add-on**
   - Railway: Click "Add Services" → PostgreSQL
   - Heroku: `heroku addons:create heroku-postgresql:mini`
   - Render: Add Render PostgreSQL

2. **Update config.php**
   - Replace CSV file operations with PDO/MySQLi
   - Create migration script

3. **Deploy**
   ```bash
   git add .
   git commit -m "Migrate to database"
   git push origin main
   ```

---

## Recommended Deployment Path

1. **For Learning/Demo**: Use **Railway** (easiest, free tier)
2. **For Production**: Use **Railway** or **Traditional Hosting**
3. **For Long-term**: Add database for better scalability

---

## Quick Links

- **Railway**: https://railway.app
- **Heroku**: https://www.heroku.com
- **Render**: https://render.com
- **GitHub**: https://github.com/codingrandomly/ExpenseMate

---

**Choose Railway for the easiest deployment!** 🚀
