<?php

declare(strict_types=1);

namespace VitesseCms\Media\Utils;

use Lukaswhite\PodcastFeedParser\Parser;
use Phalcon\Di\Di;
use stdClass;
use VitesseCms\Admin\Helpers\PaginationHelper;
use VitesseCms\Core\Enum\CacheEnum;
use VitesseCms\Core\Enum\UrlEnum;
use VitesseCms\Core\Services\CacheService;
use VitesseCms\Core\Utils\UrlUtil;
use VitesseCms\Mustache\DTO\RenderPartialDTO;
use VitesseCms\Mustache\DTO\RenderTemplateDTO;
use VitesseCms\Mustache\Enum\ViewEnum;

final class PodcastUtil
{
    public static function isValidUrl(string $url): bool
    {
        return UrlUtil::exists($url) && simplexml_load_string(file_get_contents($url));
    }

    public static function getEmbeddCode($url): string
    {
        $evenstManager = Di::getDefault()->get('eventsManager');
        /** @var CacheService $cacheService */
        $cacheService = $evenstManager->fire(CacheEnum::ATTACH_SERVICE_LISTENER, new stdClass());
        $cacheKey = $cacheService->getCacheKey($url);
        $content = $cacheService->get($cacheKey);
        if ($content === null) {
            $content = file_get_contents($url);
        }

        $parser = new Parser();
        $parser->setContent($content);
        $podcasts = $parser->run();

        $pagination = new PaginationHelper(
            $podcasts->getEpisodes()->getIterator(),
            $evenstManager->fire(UrlEnum::ATTACH_SERVICE_LISTENER, new stdClass()),
            Di::getDefault()->get('request')->get('offset', 'int') ?? 0
        );

        $paginationRendered = $evenstManager->fire(
            ViewEnum::RENDER_PARTIAL_EVENT,
            new RenderPartialDTO('bootstrap/pagination_helper', ['pagination' => $pagination])
        );

        return $evenstManager->fire(
            ViewEnum::RENDER_TEMPLATE_EVENT,
            new RenderTemplateDTO('podcasts', '', [
                'description' => $podcasts->getDescription(),
                'link' => $podcasts->getLink(),
                'mostRecentEpisode' => $podcasts->getEpisodes()->mostRecent(),
                'episodes' => $pagination->getSliced(),
                'pagination' => $paginationRendered
            ])
        );
    }
}