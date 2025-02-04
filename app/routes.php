<?php

use App\Core\Router;
use App\Controller\ArticleController;

$router = new Router();

// Article routes
$router->add('GET', '/', ArticleController::class, 'index');
$router->add('GET', '/articles', ArticleController::class, 'index');
$router->add('GET', '/articles/create', ArticleController::class, 'create');
$router->add('POST', '/articles/create', ArticleController::class, 'create');
$router->add('GET', '/articles/show/{id}', ArticleController::class, 'show');

// Get the current request URI and method
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Dispatch the request
$router->dispatch($requestUri, $requestMethod);