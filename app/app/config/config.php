<?php

return [
    'database' => [
        'host' => $_ENV['DATABASE_URL'] ?? 'localhost',
        'port' => $_ENV['DATABASE_PORT'] ?? '3306',
        'dbname' => $_ENV['DATABASE_NAME'] ?? '',
        'username' => $_ENV['DATABASE_USER'] ?? '',
        'password' => $_ENV['DATABASE_PASSWORD'] ?? '',
        'charset' => $_ENV['DATABASE_CHARSET'] ?? '',
    ]
];
