<?php declare(strict_types=1);

namespace VitesseCms\Media\Enums;

use VitesseCms\Core\AbstractEnum;

class MediaEnum extends AbstractEnum
{
    public const ASSETS_LOAD_GENERIC = 'assets:loadGeneric';
    public const ASSETS_INIT_START = 'assets:initStart';
    public const ASSETS_INIT_END = 'assets:initEnd';
    public const ASSETS_LISTENER = 'assets';
}