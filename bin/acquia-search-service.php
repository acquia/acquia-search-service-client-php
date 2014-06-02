<?php

namespace Acquia\Search\API\Console;

use Acquia\Rest\ServiceManager;

// Try to find the appropriate autoloader.
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';
} elseif (__DIR__ . '/../../../autoload.php') {
    require __DIR__ . '/../../../autoload.php';
}

$services = new ServiceManager(array(
    'conf_dir' => $_SERVER['HOME'] . '/.Acquia/auth',
));

$app = new SearchServiceApplication($services);
$app->add(new IdentityRemoveCommand());
$app->add(new IndexCommand());
$app->add(new PingCommand());
$app->run();