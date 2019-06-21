<?php
/**
 * Loads the vendors
 */

use DI\ContainerBuilder;

require '../vendor/autoload.php';

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions(__DIR__ . '/kernel.php');
$container = $containerBuilder->build();

return $container;