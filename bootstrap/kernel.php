<?php

/**
 * This script return the way that the DI container will resolve the dependencies
 */

use App\Controllers\ReportController;
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

    // config controller
    ReportController::class => function () {
        return new ReportController(
            new UploadFile(ServerRequest::fromGlobals()),
            new Response()
        );
    },

];