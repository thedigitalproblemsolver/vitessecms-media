<?php declare(strict_types=1);

namespace VitesseCms\Media\Listeners;

use Phalcon\Events\Event;
use Phalcon\Events\Manager;
use VitesseCms\Media\Enums\MediaEnum;
use VitesseCms\Media\Services\AssetsService;

class RenderListener
{
    private Manager $eventsManager;
    private AssetsService $assetsService;

    public function __construct(Manager $eventsManager, AssetsService $assetsService)
    {
        $this->eventsManager = $eventsManager;
        $this->assetsService = $assetsService;
    }

    public function buildJs(Event $event): void
    {
        $this->eventsManager->fire(MediaEnum::ASSETS_INIT_START, $this->assetsService);
        foreach ($this->assetsService->getEventLoaders() as $event):
            $this->eventsManager->fire($event, $this->assetsService);
        endforeach;
        $this->eventsManager->fire(MediaEnum::ASSETS_INIT_END, $this->assetsService);
    }

    public function loadAssets(Event $event): void
    {
        $this->assetsService->loadBootstrapJs();
        $this->assetsService->loadMustache();
        $this->assetsService->loadShop();
        $this->assetsService->loadSite();
    }
}