<?php declare(strict_types=1);

namespace VitesseCms\Media;

use VitesseCms\Media\Helpers\BootstrapMediaService;

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/../../vitessecms/src/core/services/BootstrapService.php';
require_once __DIR__ . '/services/BootstrapMediaService.php';
require_once __DIR__ . '/../../vitessecms/src/core/AbstractInjectable.php';
require_once __DIR__ . '/../../vitessecms/src/core/services/AbstractInjectableService.php';
require_once __DIR__ . '/../../vitessecms/src/core/services/UrlService.php';
require_once __DIR__ . '/../../vitessecms/src/core/utils/DirectoryUtil.php';
require_once __DIR__ . '/../../vitessecms/src/core/utils/SystemUtil.php';
require_once __DIR__ . '/../../vitessecms/src/core/utils/BootstrapUtil.php';
require_once __DIR__ . '/../../vitessecms/src/core/services/CacheService.php';
require_once __DIR__ . '/../../configuration/src/utils/AbstractConfigUtil.php';
require_once __DIR__ . '/../../configuration/src/utils/AccountConfigUtil.php';
require_once __DIR__ . '/../../configuration/src/utils/DomainConfigUtil.php';
require_once __DIR__ . '/../../vitessecms/src/core/utils/DebugUtil.php';
require_once __DIR__ . '/../../configuration/src/services/ConfigService.php';

$bootstrap = new BootstrapMediaService();
$bootstrap
    ->setSession()
    ->setCache()
    ->setUrl()
    ->loadConfig()
    ->loaderSystem()
    ->router()
    ->view()
;

echo $bootstrap->application()->handle()->getContent();
