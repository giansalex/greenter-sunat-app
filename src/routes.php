<?php

// Routes
$app->get('/', 'Greenter\Sunat\Controller\HomeController:index');
$app->get('/swagger', 'Greenter\Sunat\Controller\HomeController:swagger');
$app->post('/api/login', 'Greenter\Sunat\Controller\SecureController:login');
$app->post('/api/register', 'Greenter\Sunat\Controller\SecureController:register');

$app->group('/api/v1', function () {
    $this->get('/sale/{ruc:[0-9]+}', 'Greenter\Sunat\Controller\SaleController:invoice');
    $this->get('/note/{ruc:[0-9]+}', 'Greenter\Sunat\Controller\SaleController:note');
    $this->get('/rrhh/{ruc:[0-9]+}', 'Greenter\Sunat\Controller\SaleController:rrhh');
});
