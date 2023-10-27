<?php

declare(strict_types=1);

namespace VitesseCms\Media\Helpers;

use Phalcon\Di\Di;
use VitesseCms\Core\Factories\ObjectFactory;
use VitesseCms\Mustache\DTO\RenderPartialDTO;
use VitesseCms\Mustache\Enum\ViewEnum;

final class VideoEmbeddHelper
{
    protected static array $url;

    public static function getEmbeddCode(string $url = null): string
    {
        if (is_string($url)) :
            self::setUrl($url);
        endif;

        $video = ObjectFactory::create();
        switch (VideoEmbeddHelper::getProvider()) :
            case 'youtube':
                if (isset(self::$url['query']['v'])) :
                    $video->set('videoId', self::$url['query']['v']);
                else :
                    $video->set('videoId', str_replace('/', '', self::$url['path']));
                endif;
                break;
        endswitch;
        
        if ($video->_('videoId')) :
            return Di::getDefault()->get('eventsManager')->fire(
                ViewEnum::RENDER_PARTIAL_EVENT,
                new RenderPartialDTO('video/' . self::getProvider(), ['video' => $video])
            );
        endif;

        return '';
    }

    public static function setUrl(string $url): void
    {
        self::$url = parse_url($url);
        if (isset(self::$url['query'])) :
            parse_str(self::$url['query'], self::$url['query']);
        endif;
    }

    public static function getProvider(string $url = null): string
    {
        if (is_string($url)) :
            self::setUrl($url);
        endif;
        if (
            substr_count(self::$url['host'], 'youtube')
            || substr_count(self::$url['host'], 'youtu.be')
        ) :
            return 'youtube';
        endif;

        return '';
    }
}
