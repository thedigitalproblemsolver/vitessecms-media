<?php declare(strict_types=1);

namespace VitesseCms\Media;

use VitesseCms\Media\Helpers\BootstrapAssetsService;

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/../../core/src/services/BootstrapService.php';
require_once __DIR__ . '/services/BootstrapAssetsService.php';
require_once __DIR__ . '/../../core/src/AbstractInjectable.php';
require_once __DIR__ . '/../../core/src/services/AbstractInjectableService.php';
require_once __DIR__ . '/../../core/src/services/UrlService.php';
require_once __DIR__ . '/../../core/src/utils/DirectoryUtil.php';
require_once __DIR__ . '/../../core/src/utils/SystemUtil.php';
require_once __DIR__ . '/../../core/src/utils/BootstrapUtil.php';
require_once __DIR__ . '/../../core/src/services/CacheService.php';
require_once __DIR__ . '/../../configuration/src/utils/AccountConfigUtil.php';
require_once __DIR__ . '/../../configuration/src/utils/DomainConfigUtil.php';
require_once __DIR__ . '/../../core/src/utils/DebugUtil.php';
require_once __DIR__ . '/../../configuration/src/services/ConfigService.php';

$bootstrap = new BootstrapAssetsService();
$bootstrap
    ->setSession()
    ->setCache(__DIR__.'/../../../../cache/')
    ->setUrl()
    ->loadConfig()
    ->loaderSystem()
    ->router()
    ->view()
;

echo $bootstrap->application()->handle()->getContent();
