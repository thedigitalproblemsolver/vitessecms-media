<?php declare(strict_types=1);

namespace VitesseCms\Media;

use VitesseCms\Core\Utils\DebugUtil;
use VitesseCms\Media\Helpers\BootstrapMediaService;

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/../../core/src/Services/BootstrapService.php';
require_once __DIR__ . '/../../core/src/CoreApplicaton.php';
require_once __DIR__ . '/Services/BootstrapMediaService.php';
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
require_once __DIR__ . '/../../configuration/src/Services/ConfigService.php';

$cacheLifeTime = 604800;
$useCache = $_SESSION['cache'] ?? true;
if (DebugUtil::isDev()) :
    $cacheLifeTime = 1;
    $useCache = false;
endif;

$bootstrap = new BootstrapMediaService();
$bootstrap
    ->setSession()
    ->setCache(
        __DIR__ . '/../../../../cache/',
        $useCache,
        $cacheLifeTime
    )
    ->setUrl()
    ->loadConfig()
    ->loaderSystem()
    ->router()
    ->view();

echo $bootstrap->application()->handle()->getContent();
