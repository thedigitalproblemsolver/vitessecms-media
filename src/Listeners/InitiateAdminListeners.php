<?php declare(strict_types=1);

namespace VitesseCms\Media\Listeners;

use Phalcon\Events\Manager;
use VitesseCms\Media\Blocks\Image;
use VitesseCms\Media\Blocks\Logo;

class InitiateAdminListeners
{
    public static function setListeners(Manager $eventsManager): void
    {
        $eventsManager->attach(Image::class, new BlockImageListener());
        $eventsManager->attach(Logo::class, new BlockLogoListener());
    }
}
