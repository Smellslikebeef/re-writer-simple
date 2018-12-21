<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$container = require_once 'app/bootstrap.php';

return ConsoleRunner::createHelperSet($container->get(\Doctrine\ORM\EntityManager::class));