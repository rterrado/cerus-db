<?php

declare(strict_types=1);

ini_set('error_reporting','E_ALL');
ini_set( 'display_errors','1');

require '../../autoloader.php';

use \cerus\ApiClient\Request;
use \cerus\ApiClient\Response;
use \cerus\ApiClient\CerusExceptions;
use \cerus\Auth\Checkpoint;
use \cerus\Models\CerusInstanceModel;
use \cerus\Models\ClientModel;
use \cerus\Controllers\ClientController;

$request = new Request;
$response = new Response;

if (!isset($request->query()->instance)) {
    $response->abort(CerusExceptions::REQUIRES_INSTANCE_NAME);
    exit();
}

$instance = new CerusInstanceModel(
    $request->query()->instance
);

if (!$instance->doExist()) {
    $response->abort(CerusExceptions::INSTANCE_NOT_EXISTING);
    exit();
}

if (!isset($request->payload()->appkey)) {
    $response->abort(CerusExceptions::REQUIRES_APP_KEY);
    exit();
}

if (!isset($request->payload()->secretkey)) {
    $response->abort(CerusExceptions::REQUIRES_SECRET_KEY);
    exit();
}

if(!Checkpoint::isAuth(
    $instance,
    $request->payload()->appkey,
    $request->payload()->secretkey
)){
    $response->unauthorized('401:Unauthorized');
    exit();
}

if (!isset($request->payload()->clientname)) {
    $response->abort('Exception::Requires client name');
    exit();
}

$client = new ClientModel(
    $request->payload()->clientname
);

if ($client->doExist()) {
    $response->abort('Exception::Client namespace is existing');
    exit();
}

ClientController::create($client);

$response->code(200)
         ->json([
             '@namespace' => $client->getNamespace(),
             '@publicKey' => $client->getPublicKey(),
             '@privateKey' => $client->getPrivateKey(),
             '@createdAt' => $client->getCreatedAt(),
             '@status' => $client->getStatus()
         ])
         ->send();
