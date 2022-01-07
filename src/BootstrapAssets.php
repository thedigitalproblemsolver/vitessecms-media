<?php declare(strict_types=1);

namespace VitesseCms\Media;

use VitesseCms\Core\Enum\EnvEnum;
use VitesseCms\Core\Utils\DebugUtil;
use VitesseCms\Media\Helpers\BootstrapAssetsService;

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/../../core/src/Services/BootstrapService.php';
require_once __DIR__ . '/Services/BootstrapAssetsService.php';
require_once __DIR__ . '/../../core/src/AbstractInjectable.php';
require_once __DIR__ . '/../../core/src/Services/AbstractInjectableService.php';
require_once __DIR__ . '/../../core/src/Services/UrlService.php';
require_once __DIR__ . '/../../core/src/Utils/DirectoryUtil.php';
require_once __DIR__ . '/../../core/src/Utils/SystemUtil.php';
require_once __DIR__ . '/../../core/src/Utils/BootstrapUtil.php';
require_once __DIR__ . '/../../core/src/Services/CacheService.php';
require_once __DIR__ . '/../../configuration/src/Utils/AccountConfigUtil.php';
require_once __DIR__ . '/../../configuration/src/Utils/DomainConfigUtil.php';
require_once __DIR__ . '/../../core/src/Utils/DebugUtil.php';
require_once __DIR__ . '/../../core/src/AbstractEnum.php';
require_once __DIR__ . '/../../core/src/Enum/EnvEnum.php';
require_once __DIR__ . '/../../configuration/src/Services/ConfigServiceInterface.php';
require_once __DIR__ . '/../../configuration/src/Services/ConfigService.php';

$cacheLifeTime = (int)getenv(EnvEnum::CACHE_LIFE_TIME);

$bootstrap = new BootstrapAssetsService();
$bootstrap
    ->setSession()
    ->setCache(
        __DIR__ . '/../../../../cache/',
        $cacheLifeTime
    )
    ->setUrl()
    ->loadConfig()
    ->loaderSystem()
    ->router()
    ->view();

echo $bootstrap->application()->handle()->getContent();
