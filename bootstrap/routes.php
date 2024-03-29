<?php

use App\Controllers\HomeController;
use App\Controllers\ReportController;
use App\Controllers\UploadController;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

$container = require __DIR__ . '/app.php';

$dispatcher = simpleDispatcher(function (RouteCollector $route) {
    $route->addRoute('GET', '/', HomeController::class);
    $route->addRoute('POST', '/upload', [UploadController::class, 'upload']);
    $route->addRoute('GET', '/report/{report}', [ReportController::class, 'show']);
});

$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;

    case Dispatcher::METHOD_NOT_ALLOWED:
        echo '405 Method Not Allowed';
        break;

    case Dispatcher::FOUND:
        $controller = $route[1];
        $parameters = $route[2];

        // We could do $container->get($controller) but $container->call()
        // does that automatically
        echo $container->call($controller, $parameters);
        break;
}