<?php declare(strict_types=1);

namespace VitesseCms\Media\Listeners\Blocks;

use Phalcon\Events\Event;
use VitesseCms\Block\Forms\BlockForm;
use VitesseCms\Form\Models\Attributes;
use VitesseCms\Media\Blocks\Logo;
use VitesseCms\Setting\Enum\CallingNameEnum;
use VitesseCms\Setting\Enum\TypeEnum;
use VitesseCms\Setting\Factory\SettingFactory;

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

    public function beforeBlockSave(Event $event, Logo $logo): void
    {
        if (isset($logo->logo_default)) :
            SettingFactory::create(
                CallingNameEnum::LOGO_DEFAULT,
                TypeEnum::IMAGE,
                $logo->logo_default,
                'Logo core',
                true
            )->save();
        endif;

        if (isset($logo->logo_mobile)) :
            SettingFactory::create(
                CallingNameEnum::LOGO_MOBILE,
                TypeEnum::IMAGE,
                $logo->logo_mobile,
                'Logo mobile',
                true
            )->save();
        endif;

        if (isset($logo->logo_email)) :
            SettingFactory::create(
                CallingNameEnum::LOGO_EMAIL,
                TypeEnum::IMAGE,
                $logo->logo_email,
                'Logo e-mail',
                true
            )->save();
        endif;

        if (isset($logo->favicon)) :
            SettingFactory::create(
                CallingNameEnum::FAVICON,
                TypeEnum::IMAGE,
                $logo->favicon,
                'Logo favicon',
                true
            )->save();
        endif;

        unset($logo->logo_default, $logo->logo_mobile, $logo->logo_email, $logo->favicon);
    }
}
