<?php

return [
    'database' => [
        'host' => getenv('DATABASE_URL') ?: 'localhost',
        'port' => getenv('DATABASE_PORT') ?: '3306',
        'dbname' => getenv('DATABASE_NAME') ?: '',
        'username' => getenv('DATABASE_USER') ?: '',
        'password' => getenv('DATABASE_PASSWORD') ?: '',
        'charset' => getenv('DATABASE_CHARSET') ?: '',
    ]
];
