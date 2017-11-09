<?php
$curren_dir = __DIR__;
return [
    'settings' => [
        'displayErrorDetails' => false, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Db
        'db' => [
            'dsn' => 'sqlite:'. $curren_dir.'/data/greenter.sqlite',
            'user' => null,
            'pass' => null,
        ],

        // JWT
        'jwt' => [
            'secret' => 'ak5lkji3bAioTjm'
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => $curren_dir . '/../logs/app.log',
            'level' => \Monolog\Logger::INFO,
        ],
    ],
];
