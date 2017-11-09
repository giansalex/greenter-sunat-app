<?php
// Application middleware

$container = $app->getContainer();

// JWT
//$app->add(new \Slim\Middleware\JwtAuthentication([
//    "secure" => false,
//    "attribute" => "jwt",
//    "path" => '/api',
//    "passthrough" => ["/api/v1/login", "/api/v1/register"],
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