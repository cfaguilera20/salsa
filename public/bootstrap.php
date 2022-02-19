<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

// Service locator
$serviceLocator = new \Core\ServiceLocator\ServiceLocator();

// Router
$router = new \Core\Router\Router($serviceLocator);
$router->addRoute('GET', '/', '\App\controllers\UserController::index');
$router->addRoute('GET', '/sign-up', '\App\controllers\UserController::create');
$router->addRoute('POST', '/sign-up', '\App\controllers\UserController::store');
$router->addRoute('GET', '/user', '\App\controllers\UserController::show');
$router->addRoute('GET', '/change-password', '\App\controllers\UserController::edit');
$router->addRoute('POST', '/change-password', '\App\controllers\UserController::update');

$router->addRoute('GET', '/sign-in', '\App\controllers\SessionController::create');
$router->addRoute('GET', '/sign-in', '\App\controllers\SessionController::store');
$router->addRoute('GET', '/sign-out', '\App\controllers\SessionController::destroy');

// Repository
$serviceLocator->add('repository.user', new \Core\Account\Persistence\Local\UserRepository());

// Injector
$serviceLocator->add('router', $router);
$serviceLocator->add('templating', new \Core\Templating\HtmlTemplating(dirname(__DIR__).'/app/views'));

$router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
