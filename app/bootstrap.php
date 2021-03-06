<?php
// bootstrap.php
require_once __DIR__ . "/../vendor/autoload.php";

use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions(__DIR__ . '/config.php');
$container = $containerBuilder->build();
return $container;