<?php declare(strict_types=1);

namespace VitesseCms\Media\Listeners\Blocks;

use Phalcon\Events\Event;
use VitesseCms\Block\Forms\BlockForm;
use VitesseCms\Form\Models\Attributes;
use VitesseCms\Setting\Enum\CallingNameEnum;

class LogoListener
{
    public function buildBlockForm(Event $event, BlockForm $form): void
    {
        if (!$form->setting->has(CallingNameEnum::LOGO_DEFAULT)) :
            $form->addFilemanager('Logo standaard', 'logo_default', (new Attributes())->setRequired(true));
        endif;
        if (!$form->setting->has(CallingNameEnum::LOGO_MOBILE)) :
            $form->addFilemanager('Logo mobile', 'logo_mobile', (new Attributes())->setRequired(true));
        endif;
        if (!$form->setting->has(CallingNameEnum::LOGO_EMAIL)) :
            $form->addFilemanager('Logo email', 'logo_email', (new Attributes())->setRequired(true));
        endif;
        if (!$form->setting->has(CallingNameEnum::FAVICON)) :
            $form->addFilemanager('Favicon', 'favicon', (new Attributes())->setRequired(true));
        endif;

        $form->addToggle('Display motto', 'displayMotto');
    }
}
