<?php

declare(strict_types=1);

// ini_set('error_reporting','E_ALL');
// ini_set( 'display_errors','1');

require '../../autoloader.php';

use \cerus\ApiClient\Request;
use \cerus\ApiClient\Response;
use \cerus\ApiClient\CerusExceptions;
use \cerus\Auth\Checkpoint;
use \cerus\Models\CerusInstanceModel;
use \cerus\Models\ClientModel;
use \cerus\Controllers\ClientController;
use \cerus\Models\RecordModel;
use \cerus\Utility;
use \cerus\Executables\PostNewRecord;

$request = new Request;
$response = new Response;

# Requires instance name
if (!isset($request->query()->instance)) {
    $response->abort(CerusExceptions::REQUIRES_INSTANCE_NAME);
    exit();
}

# Instantiates
$instance = new CerusInstanceModel(
    $request->query()->instance
);

# Abort if
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

if (!isset($request->payload()->clientname)) {
    $response->abort('Exception::Requires client name');
    exit();
}

$client = new ClientModel(
    $request->payload()->clientname
);

if (!$client->doExist()) {
    $response->abort('Exception::Client do not exist');
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

// $record = new RecordModel([]);
// $record->public(json_decode(json_encode($request->payload()->public),TRUE));
// $record->private(json_decode(json_encode($request->payload()->private),TRUE));


$queueId = Utility::create32bitKey();
$recordId = Utility::create32bitKey();
$recordPublicId = Utility::create32bitKey();
$recordPrivateId = Utility::create64bitKey();

$phpUnit = PostNewRecord::create([
    'root' => $_SERVER['DOCUMENT_ROOT'],
    'id' => $recordId,
    'namespace' => $client->getNamespace(),
    'createdAt' => time(),
    'updatedAt' => time(),
    'clientPublicKey' => $client->getPublicKey(),
    'clientPrivateKey' => $client->getPrivateKey(),
    'public' => json_encode($request->payload()->public),
    'recordPublicId'=>$recordPublicId,
    'recordPrivateId'=>$recordPrivateId,
    'private' => json_encode($request->payload()->private),
    'meta' => json_encode($request->payload()->meta),
    'index' => json_encode($request->payload()->index)
]);

file_put_contents($_SERVER['DOCUMENT_ROOT'].'/.que/'.$queueId.'.php',$phpUnit);
shell_exec("/dev/null 2>/dev/null & php ".$_SERVER['DOCUMENT_ROOT']."/.que/".$queueId.".php");
//echo "/dev/null 2>/dev/null & php ".$_SERVER['DOCUMENT_ROOT']."/.que/".$queueId.".php";


$response->code(200)
         ->json([
             'message'=>'Record created',
             'recordId' => $recordId,
             'namespace' => $client->getNamespace(),
             'recordPublicId' => $recordPublicId,
             'recordPrivateId' => $recordPrivateId,
             'createdAt' => time(),
             'status' => 'active'
         ])
         ->send();



//shell_exec("php ".$_SERVER['DOCUMENT_ROOT']."/.que/delayer.php"."> /dev/null 2>/dev/null &");





//echo json_encode($request->payload()->data->public);
