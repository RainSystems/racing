#!/bin/bash

mkdir -p var/cache
mkdir -p var/logs
mkdir -p var/sessions

rm -rf app/cache/*
composer install

chown -R www-data.www-data var/cache var/logs var/sessions

apache2-foreground
