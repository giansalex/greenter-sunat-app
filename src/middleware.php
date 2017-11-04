<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
// JWT
$app->add(new \Slim\Middleware\JwtAuthentication([
    "secure" => false,
    "attribute" => "jwt",
    "path" => '/api',
    "passthrough" => ["/api/v1/auth"],
    "secret" => $container['settings']['jwt']['secret'],
    "algorithm" => ["HS256"],
]));