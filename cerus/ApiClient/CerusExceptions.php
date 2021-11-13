<?php

declare(strict_types=1);
namespace cerus\ApiClient;

class CerusExceptions {

    public const REQUIRES_INSTANCE_NAME = 'Exception::Requires instance name as query parameter';
    public const INSTANCE_INSTALLED = 'Exception::An Instance is already existing';
    public const INSTANCE_NOT_EXISTING = 'Exception::Instance not existing';
    public const REQUIRES_APP_KEY = 'Exception::Requires appkey payload';
    public const REQUIRES_SECRET_KEY = 'Exception::Requires secretkey payload';

}
