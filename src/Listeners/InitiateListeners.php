<?php declare(strict_types=1);

namespace VitesseCms\Media\Listeners;

use VitesseCms\Admin\Utils\AdminUtil;
use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Media\Enums\MediaEnum;

class InitiateListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $di): void
    {
        $di->eventsManager->attach(
            MediaEnum::ASSETS_LISTENER,
            new AssetsListener($di->configuration->getVendorNameDir())
        );
        $di->eventsManager->attach(
            MediaEnum::ASSETS_LOAD_GENERIC,
            new CookieConsentListener( AdminUtil::isAdminPage())
        );
    }
}
