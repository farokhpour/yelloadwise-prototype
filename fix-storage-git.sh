#!/bin/bash
# Script to remove storage files from git tracking

echo "Removing storage files from git tracking..."

# Remove all storage files except .gitkeep files
cd /root/prototype/application

# Remove videos
git rm --cached storage/app/public/campaigns/videos/*.mp4 2>/dev/null || true

# Remove logs
git rm --cached storage/logs/*.log 2>/dev/null || true

# Remove compiled views
git rm --cached storage/framework/views/*.php 2>/dev/null || true

# Remove cache files
git rm --cached storage/framework/cache/data/* 2>/dev/null || true
git rm --cached storage/framework/cache/data/*/* 2>/dev/null || true

# Remove session files
git rm --cached storage/framework/sessions/* 2>/dev/null || true

# Use a more comprehensive approach - remove everything in storage except .gitkeep
find storage -type f ! -name ".gitkeep" -exec git rm --cached {} \; 2>/dev/null || true

echo "Done! Now commit these changes:"
echo "  git add application/.gitignore"
echo "  git commit -m 'Remove storage files from git tracking'"
echo "  git push"

