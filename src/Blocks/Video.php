<?php declare(strict_types=1);

namespace VitesseCms\Media\Blocks;

use VitesseCms\Block\AbstractBlockModel;
use VitesseCms\Block\Models\Block;
use VitesseCms\Media\Helpers\VideoEmbeddHelper;

class Video extends AbstractBlockModel
{
    public function parse(Block $block): void
    {
        parent::parse($block);

        $block->set('videoCode', VideoEmbeddHelper::getEmbeddCode($this->view, $block->_('videoUrl')));
    }
}
