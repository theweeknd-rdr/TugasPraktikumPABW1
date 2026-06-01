<?php

declare(strict_types=1);

return [
    'app' => [
        'name' => $_ENV['APP_NAME'] ?? 'Jastipin',
        'env' => $_ENV['APP_ENV'] ?? 'local',
        'debug' => filter_var($_ENV['APP_DEBUG'] ?? true, FILTER_VALIDATE_BOOL),
        'url' => rtrim($_ENV['APP_URL'] ?? '', '/'),
    ],
    'session' => [
        'name' => $_ENV['SESSION_NAME'] ?? 'JASTIPIN_SESSION',
    ],
    'database' => [
        'uri' => $_ENV['MONGODB_URI'] ?? 'mongodb://127.0.0.1:27017',
        'name' => $_ENV['MONGODB_DATABASE'] ?? 'jastipin_db',
    ],
];
