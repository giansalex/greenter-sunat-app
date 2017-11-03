<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/{ruc}', function (Request $request, Response $response, array $args) {
    // Sample log message
    $ruc = $args['ruc'];

    // Render index view
    return $response->withJson($ruc);
});
