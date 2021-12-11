<?php

use \cerus\Controllers\InstanceController;

function install(
    object $instance
    )
{
    InstanceController::create($instance);
}
