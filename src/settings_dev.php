<?php
$curren_dir = __DIR__;
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'doctrine' => [
            'meta' => [
                'entity_path' => [
                    'src/App/Entity'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' =>  '',
                'cache' => null,
            ],
            'connection' => [
                'driver'   => 'pdo_mysql',
                'host'     => 'localhost',
                'dbname'   => 'greenter_app',
                'user'     => 'root',
                'password' => '',
            ]
        ],
        // JWT
        'jwt' => [
            'secret' => 'ak5lkji3bAioTjm'
        ],
        'crypto_key' => '6a393eca0a33b1941d0c988',
        // Xml directory
        'dir_xml' => $curren_dir.'/../data',

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : $curren_dir . '/../logs',
            'level' => Psr\Log\LogLevel::DEBUG,
        ],
    ],
];
