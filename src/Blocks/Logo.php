<?php declare(strict_types=1);

namespace VitesseCms\Media\Blocks;

use Phalcon\Di\Di;
use stdClass;
use VitesseCms\Block\AbstractBlockModel;
use VitesseCms\Block\Models\Block;
use VitesseCms\Configuration\Enums\ConfigurationEnum;
use VitesseCms\Configuration\Services\ConfigService;
use VitesseCms\Core\Enum\UrlEnum;
use VitesseCms\Core\Services\UrlService;
use VitesseCms\Core\Services\ViewService;
use VitesseCms\Setting\Enum\SettingEnum;
use VitesseCms\Setting\Services\SettingService;

class Logo extends AbstractBlockModel
{
    private readonly SettingService $settingService;
    private readonly UrlService $urlService;
    private readonly ConfigService $configService;

    public function __construct(ViewService $view, Di $di)
    {
        parent::__construct($view, $di);

        $this->settingService = $this->eventsManager->fire(SettingEnum::ATTACH_SERVICE_LISTENER->value, new stdClass());
        $this->urlService = $this->eventsManager->fire(UrlEnum::ATTACH_SERVICE_LISTENER, new stdClass());
        $this->configService = $this->eventsManager->fire(ConfigurationEnum::ATTACH_SERVICE_LISTENER->value, new stdClass());
    }

    public function getTemplateParams(Block $block): array
    {
        $params = parent::getTemplateParams($block);

        $params['BASE_URI'] = $this->urlService->getBaseUri();
        $params['WEBSITE_DEFAULT_NAME'] = $this->settingService->getString('WEBSITE_DEFAULT_NAME');
        $params['SITE_LABEL_MOTTO'] = $this->settingService->getString('SITE_LABEL_MOTTO');
        $params['logoType'] = $block->_('logoType');
        $params['displayMotto'] = $block->getBool('displayMotto');
        $params['UPLOAD_URI'] = $this->configService->getUploadUri();
        $params['SITE_LOGO_MOBILE'] = $this->settingService->getString('SITE_LOGO_MOBILE');

        return $params;
    }
}
