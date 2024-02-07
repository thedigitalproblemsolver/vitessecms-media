<?php
declare(strict_types=1);

namespace VitesseCms\Media\Listeners;

use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Media\Blocks\Image;
use VitesseCms\Media\Blocks\Logo;
use VitesseCms\Media\Blocks\Video;
use VitesseCms\Media\Enums\AssetsEnum;
use VitesseCms\Media\Enums\MediaEnum;
use VitesseCms\Media\Listeners\Blocks\ImageListener;
use VitesseCms\Media\Listeners\Blocks\LogoListener;
use VitesseCms\Media\Listeners\Blocks\VideoListener;
use VitesseCms\Media\Listeners\Services\AssetsServiceListener;

class InitiateAdminListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $injectable): void
    {
        $injectable->eventsManager->attach(Image::class, new ImageListener());
        $injectable->eventsManager->attach(Logo::class, new LogoListener());
        $injectable->eventsManager->attach(Video::class, new VideoListener());
        $injectable->eventsManager->attach(
            MediaEnum::ASSETS_LISTENER,
            new AssetsListener($injectable->configuration->getVendorNameDir())
        );
        $injectable->eventsManager->attach(
            AssetsEnum::SERVICE_LISTENER->value,
            new AssetsServiceListener($injectable->assets)
        );
        $injectable->eventsManager->attach(
            'RenderListener',
            new RenderListener($injectable->eventsManager, $injectable->assets)
        );
    }
}
