<?php

declare(strict_types=1);

namespace VitesseCms\Media\Utils;

use Lukaswhite\PodcastFeedParser\Parser;
use Phalcon\Di\Di;
use VitesseCms\Core\Utils\UrlUtil;
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
        $parser = new Parser();
        $parser->setContent(file_get_contents($url));
        $podcasts = $parser->run();

        return Di::getDefault()->get('eventsManager')->fire(
            ViewEnum::RENDER_TEMPLATE_EVENT,
            new RenderTemplateDTO('podcasts', '', [
                'description' => $podcasts->getDescription(),
                'link' => $podcasts->getLink(),
                'mostRecentEpisode' => $podcasts->getEpisodes()->mostRecent()
            ])
        );
    }
}