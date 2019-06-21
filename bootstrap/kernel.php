<?php

/**
 * This script return the way that the DI container will resolve the dependencies
 */

use App\Controllers\UploadController;
use App\Services\Upload\UploadFile;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return [
    // Configure Twig
    Environment::class => function () {
        $loader = new FilesystemLoader(__DIR__ . '/../resources/views');
        return new Environment($loader);
    },

    // DI for UploadController
    UploadController::class => function () {
        return new UploadController(
            new UploadFile(ServerRequest::fromGlobals()),
            new Response()
        );
    },
];