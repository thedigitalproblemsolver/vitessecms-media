<?php declare(strict_types=1);

namespace VitesseCms\Media\Listeners;

use Phalcon\Events\Event;
use VitesseCms\Block\Forms\BlockForm;
use VitesseCms\Form\Models\Attributes;

class BlockVideoListener
{
    public function buildBlockForm(Event $event, BlockForm $form): void
    {
        $form->addText('Video-url', 'videoUrl', (new Attributes())->setRequired()->setMultilang())
            ->addFilemanager('Video-poster', 'videoPoster', (new Attributes())->setMultilang())
        ;
    }
}
