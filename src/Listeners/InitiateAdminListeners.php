<?php declare(strict_types=1);

namespace VitesseCms\Media\Listeners;

use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Media\Blocks\Image;
use VitesseCms\Media\Blocks\Logo;
use VitesseCms\Media\Blocks\Video;
use VitesseCms\Media\Listeners\Blocks\ImageListener;
use VitesseCms\Media\Listeners\Blocks\LogoListener;
use VitesseCms\Media\Listeners\Blocks\VideoListener;

class InitiateAdminListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $di): void
    {
        $di->eventsManager->attach(Image::class, new ImageListener());
        $di->eventsManager->attach(Logo::class, new LogoListener());
        $di->eventsManager->attach(Video::class, new VideoListener());
    }
}
