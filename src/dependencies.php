<?php
// DIC configuration

use Greenter\Sunat\Controller\CategoryController;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['em'] = function ($c) {
    $settings = $c->get('settings');
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $settings['doctrine']['meta']['entity_path'],
        $settings['doctrine']['meta']['auto_generate_proxies'],
        $settings['doctrine']['meta']['proxy_dir'],
        $settings['doctrine']['meta']['cache'],
        false
    );
    return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
};

$container['serializer'] = function () {
    $encoders = array(new JsonEncoder());
    $normalizers = array(new DateTimeNormalizer(), new GetSetMethodNormalizer());

    return new Serializer($normalizers, $encoders);
};

$container['service.validator'] = function () {
    return new \Greenter\Sunat\Service\UserValidator();
};

$container['service.crypto'] = function () {
    return new \Greenter\Sunat\Service\CryptoSecure();
};

$container['repository.profile'] = function ($c) {
    return new \Greenter\Sunat\Repository\ProfileRepository($c);
};

$container['xml.repo'] = function ($c) {
    return new \Greenter\Sunat\Repository\XmlRepository($c->get('settings')['dir_xml']);
};

$container['parser.invoice'] = function () {
    return new \Greenter\Xml\Parser\InvoiceParser();
};

$container['parser.note'] = function () {
    return new \Greenter\Xml\Parser\NoteParser();
};

$container['parser.rrhh'] = function () {
    return new \Greenter\Xml\Parser\ReceiptParser();
};

$container['consult.ruc'] = function () {
    return new \Peru\Sunat\Ruc();
};

$container['consult.dni'] = function () {
    return new \Peru\Reniec\Dni();
};

$container[CategoryController::class] = function ($c) {
    return new CategoryController($c->get('em'));
};