<?php

declare(strict_types=1);

namespace VitesseCms\Media\Listeners;

use VitesseCms\Admin\Utils\AdminUtil;
use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Media\Enums\AssetsEnum;
use VitesseCms\Media\Enums\MediaEnum;
use VitesseCms\Media\Fields\EmbeddedMedia;
use VitesseCms\Media\Listeners\Fields\EmbeddedMediaListener;
use VitesseCms\Media\Listeners\Services\AssetsServiceListener;

class InitiateListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $injectable): void
    {
        $injectable->eventsManager->attach(
            MediaEnum::ASSETS_LISTENER,
            new AssetsListener($injectable->configuration->getVendorNameDir())
        );
        $injectable->eventsManager->attach(
            MediaEnum::ASSETS_LOAD_GENERIC,
            new CookieConsentListener(AdminUtil::isAdminPage())
        );
        $injectable->eventsManager->attach(
            'RenderListener',
            new RenderListener($injectable->eventsManager, $injectable->assets)
        );
        $injectable->eventsManager->attach(
            AssetsEnum::SERVICE_LISTENER->value,
            new AssetsServiceListener($injectable->assets)
        );
        $injectable->eventsManager->attach(EmbeddedMedia::class, new EmbeddedMediaListener());
    }
}
