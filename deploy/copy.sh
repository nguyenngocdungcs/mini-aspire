#!/usr/bin/env bash

DESTINATION="/Users/admin/Work/mini-aspire"

FILE_NAME="source.tar.gz"
php artisan cache:clear
php artisan view:clear
rm storage/framework/sessions/*
rm -rf $FILE_NAME
tar -zcv -X deploy/exclude.copy.txt -f $FILE_NAME .
echo "=================================="
echo "Done"
