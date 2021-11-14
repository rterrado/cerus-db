<?php

declare(strict_types=1);
namespace cerus\Controllers;
use \cerus\models\ClientModel;
use \cerus\Utility;

class ClientController {

    public static function create(
        ClientModel $client
        )
    {

        # Creates private namespace
        mkdir("{$_SERVER['DOCUMENT_ROOT']}/.sto/{$client->getNamespace()}");

        $sto = Self::getSto($client->getNamespace());
        file_put_contents($sto.'/client.json',json_encode([
            '@namespace' => $client->getNamespace(),
            '@publicKey' => $client->getPublicKey(),
            '@privateKey' => $client->getPrivateKey(),
            '@createdAt' => $client->getCreatedAt(),
            '@status' => $client->getStatus()
        ]));



        # Creates client indexes
        mkdir("{$_SERVER['DOCUMENT_ROOT']}/.sto/{$client->getNamespace()}/ix");

        # Creates public namespace
        mkdir("{$_SERVER['DOCUMENT_ROOT']}/public/{$client->getPublicKey()}");
        mkdir("{$_SERVER['DOCUMENT_ROOT']}/public/{$client->getPublicKey()}/{$client->getPrivateKey()}");

    }

    public static function get(
        ClientModel $client
        )
    {
        $sto = Self::getSto($client->getNamespace());
        $data = [];
        $doExist = false;

        if (file_exists($sto)) {
            $data = json_decode(file_get_contents($sto),TRUE);
            $doExist = true;
        }

        $client->isExisting = $doExist;
        $client->setPublicKey($data['@publicKey']??Utility::create32bitKey());
        $client->setPrivateKey($data['@privateKey']??Utility::create32bitKey());
        $client->setCreatedAt($data['@createdAt']??time());
        $client->setStatus($data['@status']??'active');
    }

    private static function getSto(
        string $namespace
        )
    {
        return "{$_SERVER["DOCUMENT_ROOT"]}/.sto/{$namespace}";
    }


}
