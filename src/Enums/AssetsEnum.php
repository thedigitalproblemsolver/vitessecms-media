<?php declare(strict_types=1);

namespace VitesseCms\Media\Enums;

enum AssetsEnum: string
{
    case ATTACH_SERVICE_LISTENER = 'assetsService:attach';
    case SERVICE_LISTENER = 'assetsService';
    case RENDER_LISTENER = 'RenderListener';
    case RENDER_LISTENER_LOAD_ASSETS = 'RenderListener:loadAssets';
    case RENDER_LISTENER_BUILD_JAVASCRIPT = 'RenderListener:buildJs';
}
