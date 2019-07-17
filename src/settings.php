<?php

    $dbconfig = [
        'driver'    => 'mysql',
        'host'      => 'localhost:3306',
        'database'  => 'musee',
        'username'  => 'admin',
        'password'  => 'admin'
    ];

if (isset($_SERVER["HTTP_HOST"]) && $_SERVER["HTTP_HOST"] == 'localhost') {
    $dbconfig = [
        'driver'    => 'mysql',
        'host'      => 'localhost:3306',
        'database'  => 'musee',
        'username'  => 'admin',
        'password'  => 'admin'
    ];
}

return [
    'settings' => [
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true, // set to false in production
        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],
        'database' => $dbconfig,
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../log/app.log',
        ],
    ]
];
