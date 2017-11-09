<?php
$curren_dir = __DIR__;
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Db
        'db' => [
            'dsn' => 'sqlite:'. $curren_dir.'/../data/greenter.sqlite',
            'user' => null,
            'pass' => null,
        ],

        // JWT
        'jwt' => [
            'secret' => 'ak5lkji3bAioTjm'
        ],

        // Xml directory
        'dir_xml' => $curren_dir.'/../data',

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : $curren_dir . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
