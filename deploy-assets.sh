#!/bin/bash
# Script to rebuild Vue.js assets on the server after pulling code

echo "🔨 Rebuilding Vue.js assets using Docker..."

# Build assets using Docker nodejs container
docker compose exec nodejs npm install
docker compose exec nodejs npm run build

echo "✅ Assets rebuilt successfully!"
echo ""
echo "Next steps:"
echo "1. Clear browser cache or do a hard refresh (Ctrl+Shift+R)"
echo "2. Check the campaign creation page at /epic/digital-taxi-rooftop/campaign/create"

