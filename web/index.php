<?php

$container = require __DIR__ . '/../app/bootstrap.php';

use Bramus\Router\Router;

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
$router = new Router();

$router->get('/(.*)', function() use ($container, $request) {
    $repo = $container->get(\Doctrine\ORM\EntityManager::class)->getRepository(\ReWriter\Entity\Url::class);
    $urls = $repo->findAll();
    echo $container->get(Twig_Environment::class)->render('index.html.twig',[
        'urls' => $urls
    ]);
});

$router->run();