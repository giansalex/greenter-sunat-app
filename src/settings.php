<?php
$curren_dir = __DIR__;
return [
    'settings' => [
        'displayErrorDetails' => false, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'doctrine' => [
            'meta' => [
                'entity_path' => [
                    'src/App/Entity'
                ],
                'auto_generate_proxies' => false,
                'proxy_dir' =>  __DIR__.'/../logs/proxies',
                'cache' => new \Doctrine\Common\Cache\ApcuCache(),
            ],
            'connection' => [
                'driver'   => 'pdo_mysql',
                'host'     => 'localhost',
                'dbname'   => 'greenter_app',
                'user'     => 'root',
                'password' => '',
            ]
        ],
        'jwt' => [
            'secret' => 'ak5lkji3bAioTjm'
        ],
        'crypto_key' => '6a393eca0a33b1941d0c98f28d233ba4ab4191f8ef',
        'dir_xml' => $curren_dir.'/../data',
        'logger' => [
            'name' => 'slim-app',
            'path' => $curren_dir . '/../logs/app.log',
            'level' => \Monolog\Logger::INFO,
        ],
    ],
];
