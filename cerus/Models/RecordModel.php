<?php

declare(strict_types=1);
namespace cerus\Models;
use \cerus\Utility;

class RecordModel {

    public function __construct(
        array $__args
        )
    {
        $this->root = $__args['root'];
        $this->id = $__args['id'] ?? Utility::create32bitKey();
        $this->publicId = $__args['publicId'] ?? Utility::create32bitKey();
        $this->privateId = $__args['privateId'] ?? Utility::create64bitKey();
        $this->namespace = $__args['namespace'];
        $this->clientPublicKey = $__args['clientPublicKey'];
        $this->clientPrivateKey = $__args['clientPrivateKey'];
        $this->createdAt = $__args['createdAt'] ?? time();
        $this->updatedAt = $__args['updatedAt'] ?? time();
        $this->private = $__args['private'] ?? [];
        $this->public = $__args['public'] ?? [];
        $this->meta = $__args['meta'] ??[] ;
        $this->index = $__args['index'] ??[] ;
    }

    # The root of the database
    public function root (
        string $root = NULL
        )
    {
        # Getter
        if (NULL===$root) return $this->root;
        # Override
        $this->root = $root;
        return NULL;
    }

    public function clientPublicKey ( )
    {
        return $this->clientPublicKey;
    }

    public function clientPrivateKey ( )
    {
        return $this->clientPrivateKey;
    }

    public function namespace ( )
    {
        return $this->namespace;
    }

    # The unique id of the Record
    public function id (
        string $id = NULL
        )
    {
        # Getter
        if (NULL===$id) return $this->id;
        # Override
        $this->id = $id;
        return NULL;
    }

    # The public id of the Record
    public function publicId (
        string $publicId = NULL
        )
    {
        # Getter
        if (NULL===$publicId) return $this->publicId;
        # Override
        $this->publicId = $publicId;
        return NULL;
    }

    # The private id of the Record
    public function privateId (
        string $privateId = NULL
        )
    {
        # Getter
        if (NULL===$privateId) return $this->privateId;
        # Override
        $this->privateId = $privateId;
        return NULL;
    }


    # When the created has been created
    public function createdAt (
        string $createdAt = NULL
        )
    {
        # Getter
        if (NULL===$createdAt) return $this->createdAt;
        # Override
        $this->createdAt = $createdAt;
        return NULL;
    }


    # When the record has been updated
    public function updatedAt (
        string $updatedAt = NULL
        )
    {
        # Getter
        if (NULL===$updatedAt) return $this->updatedAt;
        # Override
        $this->updatedAt = $updatedAt;
        return NULL;
    }


    # Private data of the payload
    public function private (
        array $private = NULL
        )
    {
        # Getter
        if (NULL===$private) return $this->private;
        # Override
        $this->private = $private;
        return NULL;
    }


    # Public data of the payload
    public function public (
        array $public = NULL
        )
    {
        # Getter
        if (NULL===$public) return $this->public;
        # Override
        $this->public = $public;
        return NULL;
    }


    # Internal data of the payload
    public function meta (
        array $meta = NULL
        )
    {
        # Getter
        if (NULL===$meta) return $this->meta;
        # Override
        $this->meta = $meta;
        return NULL;
    }

    # Index data of the payload
    public function index (
        array $index = NULL
        )
    {
        # Getter
        if (NULL===$index) return $this->index;
        # Override
        $this->index = $index;
        return NULL;
    }


}
