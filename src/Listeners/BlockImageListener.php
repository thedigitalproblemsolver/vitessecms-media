<?php declare(strict_types=1);

namespace VitesseCms\Media\Listeners;

use Phalcon\Events\Event;
use VitesseCms\Block\Forms\BlockForm;

class BlockImageListener
{
    public function buildBlockForm(Event $event, BlockForm $form): void
    {
        $form->addFilemanager('Image', 'image');
    }
}
