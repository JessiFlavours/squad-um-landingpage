#!/bin/sh
php database/migrate.php
php database/seed.php
exec apache2-foreground
