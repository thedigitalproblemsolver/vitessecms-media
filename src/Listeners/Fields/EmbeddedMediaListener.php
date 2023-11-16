<?php

declare(strict_types=1);

namespace VitesseCms\Media\Listeners\Fields;

use Phalcon\Events\Event;
use VitesseCms\Core\DTO\BeforeExecuteFrontendRouteDTO;
use VitesseCms\Media\Helpers\VideoEmbeddHelper;

final class EmbeddedMediaListener
{
    public function beforeExecuteFrontendRoute(
        Event $event,
        BeforeExecuteFrontendRouteDTO $beforeExecuteFrontendRouteDTO
    ): void {
        if ($beforeExecuteFrontendRouteDTO->currentItem->has(
            $beforeExecuteFrontendRouteDTO->datafield->getCallingName()
        )) {
            $beforeExecuteFrontendRouteDTO->currentItem->set(
                $beforeExecuteFrontendRouteDTO->datafield->getCallingName(),
                $this->getEmbeddedCode(
                    $beforeExecuteFrontendRouteDTO->currentItem->getString(
                        $beforeExecuteFrontendRouteDTO->datafield->getCallingName()
                    )
                )
            );
        }
    }

    private function getEmbeddedCode(string $url): ?string
    {
        if (VideoEmbeddHelper::hasProvider($url)) {
            return VideoEmbeddHelper::getEmbeddCode($url);
        }


        return null;
    }
}