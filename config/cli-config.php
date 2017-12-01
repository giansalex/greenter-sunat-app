<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require __DIR__ . '/../vendor/autoload.php';

$settings = include __DIR__ . '/../src/settings_dev.php';
$settings = $settings['settings']['doctrine'];

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
    $settings['meta']['entity_path'],
    $settings['meta']['auto_generate_proxies'],
    $settings['meta']['proxy_dir'],
    $settings['meta']['cache'],
    false
);

try {
    $em = EntityManager::create($settings['connection'], $config);
    return ConsoleRunner::createHelperSet($em);

} catch (\Doctrine\ORM\ORMException $e) {
    var_dump($e);
}