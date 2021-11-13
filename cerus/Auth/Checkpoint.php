<?php

declare(strict_types=1);
namespace cerus\Auth;
use \cerus\models\CerusInstanceModel;

class Checkpoint {

    public static function isAuth(
        CerusInstanceModel $instance,
        string $appKey,
        string $secretKey
        )
    {
        if ($instance->getAppKey()!==$appKey) {
            return false;
        }
        if ($instance->getSecretKey()!==$secretKey) {
            return false;
        }
        return true;
    }

}
