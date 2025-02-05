<?php

use App\Core\Router;
use App\Controller\ArticleController;
use App\Controller\AuthController;

$router = new Router();

// routes

$router->add('GET', '/', ArticleController::class, 'index');
$router->add('GET', '/articles', ArticleController::class, 'index');
$router->add('GET', '/articles/create', ArticleController::class, 'create');
$router->add('POST', '/articles/create', ArticleController::class, 'create');
$router->add('GET', '/articles/show/{id}', ArticleController::class, 'show');
$router->add('GET', '/auth/login', AuthController::class, 'showLogin');
$router->add('POST', '/auth/login', AuthController::class, 'login');
$router->add('GET', '/auth/register', AuthController::class, 'showRegister');
$router->add('POST', '/auth/register', AuthController::class, 'register');

// this takes the current uri and the action
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Dispatch request

$router->dispatch($requestUri, $requestMethod);