<?php declare(strict_types=1);

namespace VitesseCms\Media\Blocks;

use VitesseCms\Block\AbstractBlockModel;
use VitesseCms\Block\Models\Block;

class Logo extends AbstractBlockModel
{
    public function getTemplateParams(Block $block): array
    {
        $params = [
            'block' => $block,
            'uri' => $this->getDi()->get('url')->getBaseUri(),
            'websiteName' => $this->getDi()->get('setting')->getString('WEBSITE_DEFAULT_NAME'),
            'motto' => $this->getDi()->get('setting')->getString('SITE_LABEL_MOTTO')
        ];


        return $params;
    }
}
