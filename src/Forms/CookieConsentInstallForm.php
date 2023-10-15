<?php declare(strict_types=1);

namespace VitesseCms\Media\Forms;

use VitesseCms\Form\AbstractForm;
use VitesseCms\Form\Helpers\ElementHelper;
use VitesseCms\Form\Models\Attributes;
use VitesseCms\Media\Enums\CookieConsentEnum;

class CookieConsentInstallForm extends AbstractForm
{
    public function build(): CookieConsentInstallForm
    {
        if (!$this->setting->has(CookieConsentEnum::POPUP_BACKGROUNDCOLOR, false)) :
            $this->addColorPicker(
                'Popup background color',
                CookieConsentEnum::POPUP_BACKGROUNDCOLOR,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::POPUP_TEXTCOLOR, false)) :
            $this->addColorPicker(
                'Popup text color',
                CookieConsentEnum::POPUP_TEXTCOLOR,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::BUTTON_BACKGROUNDCOLOR, false)) :
            $this->addColorPicker(
                'Button background color',
                CookieConsentEnum::BUTTON_BACKGROUNDCOLOR,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::BUTTON_TEXTCOLOR, false)) :
            $this->addColorPicker(
                'Button text color',
                CookieConsentEnum::BUTTON_TEXTCOLOR,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::CONTENT_MESSAGE, false)) :
            $this->addText(
                'Message',
                CookieConsentEnum::CONTENT_MESSAGE,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::CONTENT_DISMISS, false)) :
            $this->addText(
                'Content dismiss',
                CookieConsentEnum::CONTENT_DISMISS,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::CONTENT_LINK, false)) :
            $this->addText(
                'Content link',
                CookieConsentEnum::CONTENT_LINK,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::CONTENT_URL, false)) :
            $this->addText(
                'Content url',
                CookieConsentEnum::CONTENT_URL,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::POSITION, false)) :
            $this->addDropdown(
                'Position',
                CookieConsentEnum::POSITION,
                ( new Attributes())->setRequired()->setOptions(ElementHelper::arrayToSelectOptions(
                    [
                        'Top' => 'top',
                        'Bottom' => 'bottom'
                    ]
                ))
            );
        endif;

        $this->addSubmitButton('create');

        return $this;
    }
}