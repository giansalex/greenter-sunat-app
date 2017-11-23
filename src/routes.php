<?php

// Routes
$app->get('/', 'Greenter\Sunat\Controller\HomeController:index');
$app->get('/swagger', 'Greenter\Sunat\Controller\HomeController:swagger');

$app->group('/api/v1', function () {
    $this->post('/login', 'Greenter\Sunat\Controller\SecureController:login');
    $this->post('/register', 'Greenter\Sunat\Controller\SecureController:register');
    $this->get('/profile', 'Greenter\Sunat\Controller\ProfileController:get');
    $this->post('/profile', 'Greenter\Sunat\Controller\ProfileController:post');
    $this->get('/product/category/{id}', 'Greenter\Sunat\Controller\CategoryController:get');
    $this->get('/product/category', 'Greenter\Sunat\Controller\CategoryController:getAll');
    $this->post('/product/category', 'Greenter\Sunat\Controller\CategoryController:post');
    $this->put('/product/category', 'Greenter\Sunat\Controller\CategoryController:put');
    $this->delete('/product/category/{id}', 'Greenter\Sunat\Controller\CategoryController:delete');
    $this->get('/sale/{ruc:[0-9]+}', 'Greenter\Sunat\Controller\SaleController:invoice');
    $this->get('/note/{ruc:[0-9]+}', 'Greenter\Sunat\Controller\SaleController:note');
    $this->get('/rrhh/{ruc:[0-9]+}', 'Greenter\Sunat\Controller\SaleController:rrhh');
    $this->get('/consult/ruc/{ruc}', 'Greenter\Sunat\Controller\ConsultController:ruc');
    $this->get('/consult/dni/{dni}', 'Greenter\Sunat\Controller\ConsultController:dni');
});
