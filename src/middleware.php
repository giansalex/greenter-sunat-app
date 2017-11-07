<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
// JWT
//$app->add(new \Slim\Middleware\JwtAuthentication([
//    "secure" => false,
//    "attribute" => "jwt",
//    "path" => '/api',
//    "passthrough" => ["/api/v1/auth"],
//    "secret" => $container['settings']['jwt']['secret'],
//    "algorithm" => ["HS256"],
//]));

$app->add(new \Tuupola\Middleware\Cors([
    "origin" => ["*"],
    "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE"],
    "headers.allow" => ["Authorization", "Accept", "Content-Type"],
    "headers.expose" => [],
    "credentials" => false,
    "cache" => 0,
]));