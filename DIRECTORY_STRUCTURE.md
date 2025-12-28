# Complete Directory Structure

```
/root/prototype/
├── docker/
│   ├── Dockerfile.php-fpm          # PHP-FPM container with Laravel installation
│   ├── Dockerfile.nodejs           # Node.js container for frontend tooling
│   └── nginx/
│       └── default.conf            # Nginx configuration
├── config/
│   └── php.ini                     # PHP configuration overrides
├── application/                     # Laravel application (volume-mounted)
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Kernel.php
│   │   │   └── Middleware/
│   │   │       ├── Authenticate.php
│   │   │       ├── EncryptCookies.php
│   │   │       ├── PreventRequestsDuringMaintenance.php
│   │   │       ├── RedirectIfAuthenticated.php
│   │   │       ├── TrimStrings.php
│   │   │       ├── TrustProxies.php
│   │   │       ├── ValidateSignature.php
│   │   │       └── VerifyCsrfToken.php
│   │   ├── Models/
│   │   │   └── User.php
│   │   └── Providers/
│   │       └── AppServiceProvider.php
│   ├── bootstrap/
│   │   ├── app.php                 # Laravel bootstrap
│   │   └── cache/
│   │       └── .gitkeep
│   ├── config/
│   │   ├── app.php
│   │   └── database.php
│   ├── database/
│   │   └── migrations/
│   │       └── .gitkeep
│   ├── public/
│   │   ├── index.php               # Laravel entry point
│   │   └── .htaccess
│   ├── resources/
│   │   ├── css/
│   │   │   └── app.css
│   │   ├── js/
│   │   │   ├── app.js              # Main JS entry
│   │   │   ├── bootstrap.js        # Axios setup
│   │   │   └── components/
│   │   │       └── ExampleWizard.vue # Example Vue component
│   │   └── views/
│   │       ├── layouts/
│   │       │   └── app.blade.php   # Main layout
│   │       ├── welcome.blade.php   # Welcome page
│   │       └── example-wizard.blade.php # Vue example page
│   ├── routes/
│   │   ├── web.php                 # Web routes
│   │   └── console.php             # Console routes
│   ├── storage/
│   │   ├── app/
│   │   ├── framework/
│   │   │   ├── cache/
│   │   │   ├── sessions/
│   │   │   └── views/
│   │   └── logs/
│   ├── artisan                      # Laravel CLI
│   ├── composer.json                # PHP dependencies
│   ├── package.json                 # Node.js dependencies
│   ├── vite.config.js               # Vite configuration
│   ├── .env.example                 # Environment template
│   ├── .gitignore
│   └── phpunit.xml
├── docker-compose.yml               # Docker Compose configuration
├── .dockerignore                    # Docker ignore patterns
├── setup.sh                         # Setup script
├── README.md                        # Main documentation
└── DIRECTORY_STRUCTURE.md           # This file
```

## Key Files Explained

### Docker Configuration
- **docker-compose.yml**: Orchestrates all services (nginx, php-fpm, mysql, redis, nodejs)
- **docker/Dockerfile.php-fpm**: Builds PHP-FPM image with Laravel installation
- **docker/Dockerfile.nodejs**: Builds Node.js image for frontend tooling
- **docker/nginx/default.conf**: Nginx configuration with Vite proxy

### Laravel Application
- **application/bootstrap/app.php**: Laravel 11 bootstrap
- **application/routes/web.php**: Web routes
- **application/resources/views/**: Blade templates
- **application/resources/js/**: Vue.js components (selective use)
- **application/vite.config.js**: Vite configuration for Vue + Laravel

### Configuration
- **config/php.ini**: PHP configuration overrides
- **application/.env.example**: Environment variables template

## Volume Mounts

All containers mount `/application` to `/var/www/html`:
- **nginx**: Read-only mount
- **php-fpm**: Read-write mount
- **nodejs**: Read-write mount

This allows:
- Live editing from host
- Immediate reflection in containers
- No rebuild needed for code changes

## Network

All containers communicate via `prototype_network`:
- nginx → php-fpm:9000
- nginx → nodejs:5173
- php-fpm → mysql:3306
- php-fpm → redis:6379

