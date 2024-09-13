#!/bin/bash

set -euo pipefail

INFO="\033[0;30m\033[47m"
NC="\033[0m"

log() {
    echo -e "${INFO} INFO ${NC} $1"
}

log "Pulling latest changes from Git repository..."
git pull origin "$1"

log "Installing new composer dependencies and update autoloader..."
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
