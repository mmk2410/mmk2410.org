#!/bin/bash

# Clean aka remove public/ if it exists
if [[ -d ./public/ ]]; then
    rm -rf ./public/
fi

# Build the site using hugo
hugo

# Deploy using rsync
rsync \
    --archive \
    --verbose \
    --compress \
    --chown=marcel:www-data \
    --delete \
    --progress \
    public/ \
    tolkien:/var/www/mmk2410.org/
