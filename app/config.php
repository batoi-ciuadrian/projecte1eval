<?php

use \Monolog\Logger;
require_once __DIR__.'/../vendor/autoload.php';

return [
    'database' => [
        'name' => 'cursphp7',
        'username' => 'root',
        'password' => '',
        'connection' => 'mysql:host=localhost',
        'options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        ]
    ],
    'logs' => [
        'filename' => 'curso.log',
        'level' => Logger::WARNING
    ],
    'routes' => [
        'filename' => 'routes.php'
    ],
    'project' => [
        'namespace' => 'cursophp7'
    ],
    'swiftmailer' => [
        'smtp_server' => 'smtp.gmail.com',
        'smtp_port' => 587,
        'smtp_security' => 'tls',
        'username' => 'intranet@cipfpbatoi.es',
        'password' => 'Intranet@Batoi1718',
        'email' => 'intranet@cipfpbatoi.es',
        'name' => 'Adrian Ciucurenco'
    ],
    'security' => [
        'roles' => [
            'ROLE_ADMIN' => 3,
            'ROLE_USER' => 2,
            'ROLE_ANONYMOUS' => 1
        ]
    ]
];

