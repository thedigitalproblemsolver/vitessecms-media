<?php declare(strict_types=1);

namespace VitesseCms\Media\Listeners\Services;

use Phalcon\Events\Event;
use VitesseCms\Media\Services\AssetsService;

class AssetsServiceListener
{
    private AssetsService $assetsService;

    public function __construct(AssetsService $assetsService)
    {
        $this->assetsService = $assetsService;
    }

    public function attach(Event $event): AssetsService
    {
        return $this->assetsService;
    }
}
