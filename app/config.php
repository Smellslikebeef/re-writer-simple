<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Application;


$paths = ["/var/www/app/src/ReWriter"];
$dev = true;

// the connection configuration
$params = [
    'driver'   => 'pdo_mysql',
    'host' => getenv('MYSQL_HOST'),
    'user'     => getenv('MYSQL_USER'),
    'password' => getenv('MYSQL_PASSWORD'),
    'dbname'   => getenv('MYSQL_DATABASE'),
];

return [
    Twig_Environment::class => function() {
        $loader = new Twig_Loader_Filesystem('/var/www/app/src/ReWriter/Views');
        return new Twig_Environment($loader);
    },
    EntityManager::class => function() use ($paths, $params, $dev) {
        $config = Setup::createAnnotationMetadataConfiguration($paths, $dev, null, null, false);
        return EntityManager::create($params, $config);
    }
];