#!/bin/sh
php database/migrate.php
exec apache2-foreground
