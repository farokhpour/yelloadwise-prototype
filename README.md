# Laravel Prototyping Framework

A monolithic Laravel-based prototyping framework designed strictly for UI/UX prototyping and interaction design. This is **not** intended for production use.

## Architecture Overview

### Backend & Frontend
- **Framework**: Laravel (latest LTS)
- **Architecture**: Monolithic MVC
- **Backend Rendering**: Blade (HTML + CSS)
- **Frontend Dynamic Parts**: Vue.js (selective use for wizards, single-page flows, interactive prototypes)
- **Build Tool**: Vite (Laravel default)
- **No SPA Architecture**: Vue coexists with Blade, not replacing it

### Infrastructure Stack (Dockerized)
Each service runs in its own container:
- **nginx**: Web server, serves Laravel via php-fpm
- **php-fpm**: PHP 8.2 with required extensions
- **mysql**: Database (MySQL 8.0)
- **redis**: Cache and session storage
- **nodejs**: Frontend tooling (Vite, npm)

## Project Structure

```
/
├── docker/
│   ├── Dockerfile.php-fpm    # PHP-FPM container with Laravel installation
│   ├── Dockerfile.nodejs     # Node.js container for frontend tooling
│   └── nginx/
│       └── default.conf      # Nginx configuration
├── config/
│   └── php.ini              # PHP configuration overrides
├── application/              # Entire Laravel project (volume-mounted)
│   ├── app/
│   ├── config/
│   ├── resources/
│   │   ├── js/              # Vue components (selective use)
│   │   ├── css/
│   │   └── views/           # Blade templates
│   ├── routes/
│   ├── public/
│   └── ...
└── docker-compose.yml        # Docker Compose configuration
```

## Container Responsibilities

### nginx
- Serves static files and Laravel application
- Proxies PHP requests to php-fpm container
- Proxies Vite dev server requests to nodejs container for HMR
- Exposes port 8080 to host

### php-fpm
- Runs Laravel application
- Handles PHP execution
- Connects to MySQL and Redis
- Volume-mounted to `/application` for live editing

### mysql
- Database server
- Persistent data in `mysql_data` volume
- Credentials: `prototype/prototype` (database: `prototype`)

### redis
- Cache and session storage
- Persistent data in `redis_data` volume

### nodejs
- Runs npm and Vite
- Handles frontend asset building
- Supports `npm run watch` for hot reload
- Volume-mounted to `/application` for live editing
- `node_modules` stored in separate volume to persist dependencies

## Inter-Container Communication

All containers communicate via the `prototype_network` Docker bridge network:
- nginx → php-fpm: `php-fpm:9000`
- nginx → nodejs: `nodejs:5173` (Vite dev server)
- php-fpm → mysql: `mysql:3306`
- php-fpm → redis: `redis:6379`

## Setup Instructions

### Prerequisites
- Docker and Docker Compose installed
- Git (optional, for cloning)

### Initial Setup

1. **Build and start all containers:**
   ```bash
   docker-compose up -d --build
   ```

2. **Install Laravel dependencies (if not already installed during build):**
   ```bash
   docker-compose exec php-fpm composer install
   ```

3. **Generate Laravel application key:**
   ```bash
   docker-compose exec php-fpm php artisan key:generate
   ```

4. **Copy environment file (if needed):**
   ```bash
   cp application/.env.example application/.env
   ```

5. **Run database migrations (if any):**
   ```bash
   docker-compose exec php-fpm php artisan migrate
   ```

### Starting Frontend Watcher

The frontend watcher enables hot module replacement (HMR) for Vue components and CSS:

```bash
docker-compose exec nodejs npm run watch
```

This command:
- Runs Vite in watch mode
- Enables HMR for instant updates
- Listens on port 5173 inside the container
- Nginx proxies Vite requests automatically

**Note**: Keep this terminal session running while developing.

### Accessing the Application

- **Web Application**: http://localhost:8080
- **MySQL**: localhost:3306 (user: `prototype`, password: `prototype`, database: `prototype`)
- **Redis**: localhost:6379

## Development Workflow

### Editing Files
All files in `/application` are volume-mounted, so:
- Edit files directly on the host
- Changes are immediately reflected in containers
- No need to rebuild containers for code changes

### Vue.js Usage (Selective)

Vue.js is used **selectively**, not globally. Example usage:

1. **Create a Vue component** in `resources/js/components/`:
   ```vue
   <!-- resources/js/components/MyWizard.vue -->
   <template>
       <div>My Wizard Component</div>
   </template>
   <script>
   export default {
       name: 'MyWizard'
   }
   </script>
   ```

2. **Use it in a Blade template**:
   ```blade
   @extends('layouts.app')
   @section('content')
       <div id="wizard-app"></div>
   @endsection
   @push('vue-components')
   <script type="module">
   import { createApp } from 'vue';
   import MyWizard from '/resources/js/components/MyWizard.vue';
   const app = createApp({});
   app.component('MyWizard', MyWizard);
   app.mount('#wizard-app');
   </script>
   @endpush
   ```

3. **Access the page** - Vue will be loaded only on that page.

### Running Artisan Commands

```bash
docker-compose exec php-fpm php artisan <command>
```

Examples:
- `php artisan route:list`
- `php artisan make:controller MyController`
- `php artisan migrate`

### Running npm Commands

```bash
docker-compose exec nodejs npm <command>
```

Examples:
- `npm install <package>`
- `npm run build` (production build)
- `npm run watch` (development with HMR)

## How npm run watch Works in Docker

1. **Vite starts** in the nodejs container on port 5173
2. **Nginx proxies** requests to `/@vite/*` and `/resources/*` to the nodejs container
3. **File watching** uses polling (configured in `vite.config.js`) to detect changes across the volume mount
4. **HMR (Hot Module Replacement)** pushes updates to the browser automatically
5. **No page refresh needed** for Vue component and CSS changes

## Environment Configuration

The `.env` file in `/application` is pre-configured for Docker services:

```env
DB_HOST=mysql
DB_DATABASE=prototype
DB_USERNAME=prototype
DB_PASSWORD=prototype

REDIS_HOST=redis
REDIS_PORT=6379
```

## Troubleshooting

### Containers won't start
- Check if ports 8080, 3306, 6379 are available
- Review logs: `docker-compose logs <service-name>`

### Laravel not found
- Ensure `/application` directory exists
- Rebuild containers: `docker-compose up -d --build`

### Vite HMR not working
- Ensure `npm run watch` is running in nodejs container
- Check nginx logs: `docker-compose logs nginx`
- Verify Vite is accessible: `curl http://localhost:8080/@vite/client`

### Permission issues
- Fix storage permissions: `docker-compose exec php-fpm chmod -R 775 storage bootstrap/cache`
- Fix ownership: `docker-compose exec php-fpm chown -R www-data:www-data storage bootstrap/cache`

### Database connection errors
- Wait for MySQL to be ready: `docker-compose exec mysql mysqladmin ping -h localhost`
- Check MySQL logs: `docker-compose logs mysql`

## Stopping the Environment

```bash
# Stop all containers
docker-compose down

# Stop and remove volumes (WARNING: deletes database data)
docker-compose down -v
```

## File Permissions

The Dockerfiles set appropriate permissions, but if you encounter issues:

```bash
docker-compose exec php-fpm chown -R www-data:www-data /var/www/html
docker-compose exec php-fpm chmod -R 755 /var/www/html
docker-compose exec php-fpm chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
```

## Notes

- **This is a prototyping framework** - not hardened for production
- **No authentication scaffolding** - add only if needed
- **No queues or workers** - synchronous processing only
- **Vue is selective** - use only where needed (wizards, interactive prototypes)
- **Blade is primary** - most pages should use Blade, not Vue

## Example Pages

- `/` - Welcome page (Blade)
- `/wizard` - Example Vue.js wizard component

## Support

For issues or questions, refer to:
- [Laravel Documentation](https://laravel.com/docs)
- [Vue.js Documentation](https://vuejs.org/)
- [Vite Documentation](https://vitejs.dev/)

