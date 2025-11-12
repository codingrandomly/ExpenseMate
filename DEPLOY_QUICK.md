# ⚡ Quick Deployment Guide

## Railway (Recommended - 1 Click Deploy!)

### Option 1: Direct Deploy Link (Fastest!)
✅ Click this button or link:
```
https://railway.app/new?repo=https://github.com/codingrandomly/ExpenseMate
```

This will:
1. Authenticate with GitHub
2. Clone the repository
3. Auto-detect PHP configuration
4. Deploy your app
5. Give you a live URL in ~2-3 minutes

### Option 2: Manual Deploy on Railway
1. Go to https://railway.app
2. Sign up/Login with GitHub
3. Click "Create New Project"
4. Select "Deploy from GitHub"
5. Find "codingrandomly/ExpenseMate"
6. Click "Deploy"
7. Wait for completion
8. Get your live URL from the dashboard

---

## Why Railway?

✅ **Zero configuration** - Auto-detects PHP  
✅ **Free tier available** - $5/month credit  
✅ **Automatic HTTPS** - Secure by default  
✅ **Data persists** - CSV files don't get deleted  
✅ **Easy rollback** - If something breaks  
✅ **Real-time logs** - Debug easily  
✅ **One-click deploys** - Direct GitHub integration  

---

## After Deployment

Once your app is live:

1. **Get Your URL**
   - Check Railway dashboard
   - Format: `https://expensemate-xxxxx.railway.app`

2. **Start Using**
   - Add expenses
   - View dashboard
   - Check reports

3. **Share with Professor**
   - Send them the live URL
   - They can access anytime from browser
   - No installation needed!

---

## Troubleshooting

### Issue: "No repositories found"
**Solution**: Use the direct link above instead of searching

### Issue: Deploy fails
**Solution**: 
- Check GitHub repo is public
- Verify credentials in Railway
- Check build logs for errors

### Issue: Data not persisting
**Solution**:
- Railway keeps files by default
- CSV data should persist automatically
- Check if you're using persistent storage

---

## Alternative Platforms

If Railway doesn't work:

### Render.com
1. Visit https://render.com
2. Click "New +" → "Web Service"
3. Connect GitHub repository
4. Deploy

### Heroku
1. Install Heroku CLI
2. `heroku login`
3. `heroku create expensemate`
4. `git push heroku main`
5. `heroku open`

---

## GitHub Repository

Your code is here:
```
https://github.com/codingrandomly/ExpenseMate
```

All deployment files included:
- `Procfile` - Process definition
- `runtime.txt` - PHP version
- `composer.json` - Dependencies
- `DEPLOYMENT.md` - Full guide

---

## Live Demo

Once deployed, you can:
- ✅ Add expenses (Dashboard)
- ✅ View all expenses (View page)
- ✅ Search in real-time
- ✅ View analytics (Reports page)
- ✅ Toggle dark mode (Settings page)
- ✅ Export data as CSV

---

**Ready? Click the deploy link above! 🚀**
