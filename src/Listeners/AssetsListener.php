<?php declare(strict_types=1);

namespace VitesseCms\Media\Listeners;

use Phalcon\Events\Event;
use VitesseCms\Media\Services\AssetsService;

class AssetsListener
{
    /**
    * @var string
    */
    private $vendorBaseDir;

    public function __construct(string $vendorBaseDir)
    {
        $this->vendorBaseDir = $vendorBaseDir;
    }

    public function initStart(Event $event, AssetsService $assetsService): void
    {
        $assetsService->addInlineJs(file_get_contents($this->vendorBaseDir . 'media/src/Resources/js/initStart.js'));
    }

    public function initEnd(Event $event, AssetsService $assetsService): void
    {
        $assetsService->addInlineJs(file_get_contents($this->vendorBaseDir . 'media/src/Resources/js/initEnd.js'));
    }

    public function addRecaptcha(Event $event, AssetsService $assetsService): void
    {
        $assetsService->loadRecaptcha();
    }

    public function singleImageZoom(Event $event, AssetsService $assetsService): void
    {
        die();
        $assetsService->addInlineJs(file_get_contents($this->vendorBaseDir . 'media/src/Resources/js/initSingleImageZoom.js'));
    }
}