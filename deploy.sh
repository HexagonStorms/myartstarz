#!/bin/bash
# Deploy script for MyArtStarz
# Syncs tracked files (themes, .htaccess) to Cloudways server

set -e

SERVER="plazacodes@209.38.158.243"
SSH_KEY="~/.ssh/id_rsa_cloudways"
REMOTE_PATH="/home/1588464.cloudwaysapps.com/umxdjdkpqv/public_html"
LOCAL_DIR="$(cd "$(dirname "$0")" && pwd)"

echo "Deploying MyArtStarz to $SERVER..."

# Deploy themes
echo "Syncing themes..."
rsync -avz --delete \
  -e "ssh -i $SSH_KEY" \
  "$LOCAL_DIR/wp-content/themes/" \
  "$SERVER:$REMOTE_PATH/wp-content/themes/"

# Deploy .htaccess
echo "Syncing .htaccess..."
rsync -avz \
  -e "ssh -i $SSH_KEY" \
  "$LOCAL_DIR/.htaccess" \
  "$SERVER:$REMOTE_PATH/.htaccess"

echo "Deploy complete!"
