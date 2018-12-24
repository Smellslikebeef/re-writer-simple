<?php

$container = require __DIR__ . '/../app/bootstrap.php';

use Bramus\Router\Router;
use Symfony\Component\HttpFoundation\Request;

$router = new Router();
$request = Request::createFromGlobals();

$router->get('/(.*)', function($slug) use ($container, $request) {
    /** @var ReWriter\Service\UrlReWriterService */
    $service = $container->get(\ReWriter\Service\UrlReWriterService::class);

    if($entity = $service->fetchBySlug($slug)) {
        $response = new \Symfony\Component\HttpFoundation\RedirectResponse($entity->getLocation());
        echo $response->send();
        exit();
    }

    echo $container->get('twig')->render('index.html.twig', [
        'urls' => $service->fetchAll()
    ]);
});

$router->post('/', function() use($container, $request) {
    /** @var ReWriter\Service\UrlReWriterService */
    $service = $container->get(\ReWriter\Service\UrlReWriterService::class);
    if($service->createFromRequest($request)) {
        $response = new \Symfony\Component\HttpFoundation\RedirectResponse('/');
        $response->send();
        exit();
    }
});

$router->run();