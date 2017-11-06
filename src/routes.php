<?php

use Slim\Http\Response;

// Routes
$app->get('/', function ($request, Response $response, array $args) {
    $response->getBody()->write('<h1>GREENTER APP</h1>');

    return $response->withStatus(200);
});

$app->group('/api/v1', function () {
    $this->get('/sale/{ruc:[0-9]+}', 'Greenter\Sunat\Controller\SaleController:invoice');
    $this->get('/note/{ruc:[0-9]+}', 'Greenter\Sunat\Controller\SaleController:note');
    $this->get('/rrhh/{ruc:[0-9]+}', 'Greenter\Sunat\Controller\SaleController:rrhh');
});
