#!/bin/bash

set -e

echo "🚀 Laravel Prototyping Framework Setup"
echo "======================================"
echo ""

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker is not running. Please start Docker and try again."
    exit 1
fi

echo "📦 Building and starting Docker containers..."
docker compose up -d --build

echo ""
echo "⏳ Waiting for services to be ready..."
sleep 5

echo ""
echo "📥 Installing PHP dependencies..."
docker compose exec -T php-fpm composer install --no-interaction || echo "⚠️  Composer install had issues (may be normal if Laravel was installed during build)"

echo ""
echo "📥 Installing Node.js dependencies..."
docker compose exec -T nodejs npm install || echo "⚠️  npm install had issues"

echo ""
echo "🔑 Generating Laravel application key..."
if [ ! -f "application/.env" ]; then
    cp application/.env.example application/.env 2>/dev/null || echo "⚠️  .env.example not found, creating .env manually"
fi
docker compose exec -T php-fpm php artisan key:generate || echo "⚠️  Key generation skipped (may already exist)"

echo ""
echo "🔧 Setting permissions..."
docker compose exec -T php-fpm chmod -R 775 storage bootstrap/cache 2>/dev/null || true
docker compose exec -T php-fpm chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

echo ""
echo "✅ Setup complete!"
echo ""
echo "📋 Next steps:"
echo "   1. Build Vite assets (required for first run):"
echo "      docker compose exec nodejs npm run build"
echo ""
echo "   2. Start the frontend watcher (for development with HMR):"
echo "      docker compose exec nodejs npm run watch"
echo "      (Keep this running in a separate terminal for hot reload)"
echo ""
echo "   3. Access the application:"
echo "      http://localhost:8080"
echo ""
echo "   4. View logs:"
echo "      docker compose logs -f"
echo ""
echo "⚠️  Note: If you see 'Vite manifest not found', run:"
echo "      docker compose exec nodejs npm run build"
echo ""

