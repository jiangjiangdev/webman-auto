<?php

use Jiangjiangdev\WebmanAuto\Commands\AdminCreateCommand;
use Jiangjiangdev\WebmanAuto\Commands\AuthCreateCommand;
use Jiangjiangdev\WebmanAuto\Commands\ContentResetCommand;
use Jiangjiangdev\WebmanAuto\Commands\ResourceCreateCommand;

return [
    AuthCreateCommand::class,
    ContentResetCommand::class,
    ResourceCreateCommand::class,
    AdminCreateCommand::class,
];
