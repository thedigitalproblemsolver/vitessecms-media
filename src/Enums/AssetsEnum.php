<?php declare(strict_types=1);

namespace VitesseCms\Media\Enums;

use VitesseCms\Core\AbstractEnum;

class AssetsEnum extends AbstractEnum
{
    public const ATTACH_SERVICE_LISTENER = 'assetsService:attach';
    public const SERVICE_LISTENER = 'assetsService';
}
