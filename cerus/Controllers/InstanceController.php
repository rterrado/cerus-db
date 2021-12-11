<?php

declare(strict_types=1);
namespace cerus\Controllers;
use \cerus\models\CerusInstanceModel;
use \cerus\Utility;

class InstanceController {

    public static function create(
        CerusInstanceModel $instance
        )
    {
        $sto = Self::getSto($instance->getName());
        file_put_contents($sto,json_encode([
            '@instanceName' => $instance->getName(),
            '@appKey' => $instance->getAppKey(),
            '@secretKey' => $instance->getSecretKey(),
            '@createdAt' => $instance->getCreatedAt(),
        ]));

        # Creates client namespace
        //mkdir('./../.sto/clt');
    }

    public static function get(
        CerusInstanceModel $instance
        )
    {
        $sto = Self::getSto($instance->getName());
        $data = [];
        $doExist = false;

        if (file_exists($sto)) {
            $data = json_decode(file_get_contents($sto),TRUE);
            $doExist = true;
        }

        $instance->isExisting = $doExist;
        $instance->setAppKey($data['@appKey']??Utility::create32bitKey());
        $instance->setSecretKey($data['@secretKey']??Utility::create32bitKey());
        $instance->setCreatedAt($data['@createdAt']??time());
    }

    private static function getSto(
        string $instanceName
        )
    {
        return "{$_SERVER["DOCUMENT_ROOT"]}/.sto/{$instanceName}.json";
    }


}
