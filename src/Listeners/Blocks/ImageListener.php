<?php declare(strict_types=1);

namespace VitesseCms\Media\Listeners\Blocks;

use Phalcon\Events\Event;
use VitesseCms\Block\Forms\BlockForm;

class ImageListener
{
    public function buildBlockForm(Event $event, BlockForm $form): void
    {
        $form->addFilemanager('Image', 'image');
    }
}
