# Quick Start Guide

## Prerequisites
- Docker and Docker Compose installed
- Ports 8080, 3306, 6379 available

## Initial Setup

### Option 1: Automated Setup (Recommended)
```bash
./setup.sh
```

### Option 2: Manual Setup
```bash
# 1. Build and start containers
docker-compose up -d --build

# 2. Install PHP dependencies
docker-compose exec php-fpm composer install

# 3. Install Node.js dependencies
docker-compose exec nodejs npm install

# 4. Generate Laravel key
docker-compose exec php-fpm php artisan key:generate

# 5. Set permissions
docker-compose exec php-fpm chmod -R 775 storage bootstrap/cache
```

## Start Development

### 1. Start Frontend Watcher (Required for Vue HMR)
```bash
docker-compose exec nodejs npm run watch
```
**Keep this terminal running** - it enables hot module replacement.

### 2. Access Application
Open your browser: **http://localhost:8080**

## Common Commands

### Laravel Artisan
```bash
docker-compose exec php-fpm php artisan <command>
```

### npm Commands
```bash
docker-compose exec nodejs npm <command>
```

### View Logs
```bash
docker-compose logs -f [service-name]
```

### Stop Environment
```bash
docker-compose down
```

## Architecture Summary

- **Backend**: Laravel + Blade (MVC)
- **Frontend**: Vue.js (selective use only)
- **Build**: Vite with hot reload
- **Services**: nginx, php-fpm, mysql, redis, nodejs
- **Network**: All containers on `prototype_network`

## How It Works

1. **Docker Compose** builds images with Laravel pre-installed
2. **Volume mounts** allow live editing from host
3. **Nginx** serves Laravel and proxies Vite requests
4. **Vite** watches for changes and provides HMR
5. **All services** communicate via Docker network

## Example: Adding a Vue Component

1. Create component: `application/resources/js/components/MyComponent.vue`
2. Use in Blade template:
   ```blade
   @push('vue-components')
   <script type="module">
   import { createApp } from 'vue';
   import MyComponent from '/resources/js/components/MyComponent.vue';
   const app = createApp({});
   app.component('MyComponent', MyComponent);
   app.mount('#my-app');
   </script>
   @endpush
   ```
3. Changes appear instantly via HMR!

## Troubleshooting

**Containers won't start?**
- Check ports: `netstat -tuln | grep -E '8080|3306|6379'`
- View logs: `docker-compose logs`

**Vite HMR not working?**
- Ensure `npm run watch` is running
- Check nginx logs: `docker-compose logs nginx`

**Permission errors?**
```bash
docker-compose exec php-fpm chown -R www-data:www-data storage bootstrap/cache
docker-compose exec php-fpm chmod -R 775 storage bootstrap/cache
```

