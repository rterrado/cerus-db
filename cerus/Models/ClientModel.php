<?php

declare(strict_types=1);
namespace cerus\Models;

use \cerus\Controllers\ClientController;

class ClientModel {

    private $namespace;
    private $id;
    private $publicKey;
    private $privateKey;
    private $createdAt;
    private $status;

    public $isExisting;

    public function __construct(
        string $namespace
        )
    {
        $this->namespace = $namespace;
        $client = ClientController::get($this);
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function getPublicKey()
    {
        return $this->publicKey;
    }

    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function doExist()
    {
        return $this->isExisting;
    }


    public function setPublicKey(
        string $publicKey
        )
    {
        $this->publicKey = $publicKey;
    }

    public function setPrivateKey(
        string $privateKey
        )
    {
        $this->privateKey = $privateKey;
    }

    public function setCreatedAt(
        int $createdAt
        )
    {
        $this->createdAt = $createdAt;
    }

    public function setStatus(
        string $status
        )
    {
        $this->status = $status;
    }

}
