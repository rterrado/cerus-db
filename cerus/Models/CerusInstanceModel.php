<?php

declare(strict_types=1);
namespace cerus\Models;

use \cerus\Controllers\InstanceController;

class CerusInstanceModel {

    private $instanceName;
    private $appKey;
    private $secretKey;
    private $createdAt;

    public $isExisting;

    public function __construct(
        string $instanceName
        )
    {
        $this->instanceName = $instanceName;
        $instance = InstanceController::get($this);
    }

    public function getName()
    {
        return $this->instanceName;
    }

    public function getAppKey()
    {
        return $this->appKey;
    }

    public function getSecretKey()
    {
        return $this->secretKey;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function doExist()
    {
        return $this->isExisting;
    }


    public function setAppKey(
        string $appKey
        )
    {
        $this->appKey = $appKey;
    }

    public function setSecretKey(
        string $secretKey
        )
    {
        $this->secretKey = $secretKey;
    }

    public function setCreatedAt(
        int $createdAt
        )
    {
        $this->createdAt = $createdAt;
    }

}
