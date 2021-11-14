<?php

declare(strict_types=1);
require '../autoloader.php';

/**
 * Installation endpoint
 * Installs a new instance of Cerus DB in a server machine
 *
 * This endpoint requires the following:
 * @var string $instance -  name of the instance to be created
 *
 */

use \cerus\ApiClient\Request;
use \cerus\ApiClient\Response;
use \cerus\ApiClient\CerusExceptions;
use \cerus\Models\CerusInstanceModel;

$request = new Request();
$response = new Response();

if (!isset($request->query()->instance)) {
    $response->abort(CerusExceptions::REQUIRES_INSTANCE_NAME);
    exit();
}

# Creates a new Cerus DB Instance
$instance = new CerusInstanceModel(
    $request->query()->instance
);

# Calls the install  function that will be removed once installation is done
$installer = __DIR__.'/installer.php';

# Exits call if installer has already been deleted
if (!file_exists($installer)) {
    $response->abort(CerusExceptions::INSTANCE_INSTALLED);
    exit();
}

# Installs instance
require $installer;
install($instance);

# Removes installer
unlink($installer);

$response->code(200)
         ->json([
             '@instanceName' => $instance->getName(),
             '@appKey' => $instance->getAppKey(),
             '@secretKey' => $instance->getSecretKey(),
             '@createdAt' => $instance->getCreatedAt()
         ])
         ->send();
