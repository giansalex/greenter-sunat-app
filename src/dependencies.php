<?php
// DIC configuration

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

$container['serializer'] = function ($c) {
    $encoders = array(new JsonEncoder());
    $normalizers = array(new DateTimeNormalizer(), new GetSetMethodNormalizer());

    return new Serializer($normalizers, $encoders);
};

$container['dir_xml'] = function () {
    return __DIR__.'/data';
};

$container['xml.repo'] = function ($c) {
    return new \Greenter\Sunat\Repository\XmlRepository($c->get('dir_xml'));
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