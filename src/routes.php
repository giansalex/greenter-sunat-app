<?php

use Slim\Http\Response;

// Routes
$app->get('/', 'Greenter\Sunat\Controller\HomeController:index');
$app->get('/swagger', 'Greenter\Sunat\Controller\HomeController:swagger');

$app->group('/api/v1', function () {
    $this->get('/sale/{ruc:[0-9]+}', 'Greenter\Sunat\Controller\SaleController:invoice');
    $this->get('/note/{ruc:[0-9]+}', 'Greenter\Sunat\Controller\SaleController:note');
    $this->get('/rrhh/{ruc:[0-9]+}', 'Greenter\Sunat\Controller\SaleController:rrhh');
});
