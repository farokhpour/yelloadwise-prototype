# Vite Setup and Troubleshooting

## Quick Fix for "Vite manifest not found" Error

If you see the error: `Vite manifest not found at: /var/www/html/public/build/manifest.json`

### Option 1: Build Assets (Production/One-time)
```bash
docker compose exec nodejs npm run build
```

### Option 2: Start Development Server with HMR (Recommended for Development)
```bash
docker compose exec nodejs npm run watch
```

**Keep this terminal running** - it enables hot module replacement (HMR) for instant updates.

## Development vs Production

### Development Mode (with HMR)
- Run: `docker compose exec nodejs npm run watch`
- Vite dev server runs on port 5173
- Nginx proxies Vite requests automatically
- Changes to Vue components and CSS update instantly
- No need to rebuild after changes

### Production Mode (static assets)
- Run: `docker compose exec nodejs npm run build`
- Assets are compiled to `/public/build/`
- Manifest.json is created
- Faster page loads, but requires rebuild after changes

## How It Works

1. **Development (`npm run watch`)**:
   - Vite dev server starts in nodejs container
   - Nginx proxies `/@vite/*` and `/resources/*` to nodejs:5173
   - Laravel's `@vite()` directive detects dev mode and uses dev server
   - HMR pushes updates to browser automatically

2. **Production (`npm run build`)**:
   - Assets compiled to `/public/build/`
   - `manifest.json` maps source files to built assets
   - Laravel's `@vite()` directive reads manifest and serves built files
   - No dev server needed

## Troubleshooting

### Manifest still not found after build?
```bash
# Check if build directory exists
docker compose exec nodejs ls -la /var/www/html/public/build/

# Rebuild if needed
docker compose exec nodejs npm run build
```

### HMR not working?
1. Ensure `npm run watch` is running
2. Check nginx can reach nodejs: `docker compose exec nginx ping -c 1 nodejs`
3. Verify Vite is running: `docker compose exec nodejs ps aux | grep vite`
4. Check nginx logs: `docker compose logs nginx`

### Assets not updating?
- In development: Restart `npm run watch`
- In production: Run `npm run build` after changes

## Recommended Workflow

**For active development:**
```bash
# Terminal 1: Start Vite watcher
docker compose exec nodejs npm run watch

# Terminal 2: View logs
docker compose logs -f nginx php-fpm

# Edit files in application/
# Changes appear instantly via HMR
```

**For testing production build:**
```bash
# Build assets
docker compose exec nodejs npm run build

# Test the application
curl http://localhost:8080
```

