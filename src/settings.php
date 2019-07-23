<?php

    $dbconfig = [
        'driver'    => 'mysql',
        'host'      => 'localhost:8889',//localhost:3306
        'database'  => 'musee',
        'username'  => 'root',//admin
        'password'  => 'root'//admin
    ];

if (isset($_SERVER["HTTP_HOST"]) && $_SERVER["HTTP_HOST"] == 'localhost') {
    $dbconfig = [
        'driver'    => 'mysql',
        'host'      => 'localhost:8889',//localhost:3306
        'database'  => 'musee',
        'username'  => 'root',//admin
        'password'  => 'root'//admin
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
