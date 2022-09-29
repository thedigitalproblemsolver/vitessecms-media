<?php declare(strict_types=1);

namespace VitesseCms\Media\Forms;

use VitesseCms\Form\AbstractForm;
use VitesseCms\Form\Models\Attributes;
use VitesseCms\Media\Enums\CookieConsentEnum;

class CookieConsentInstallForm extends AbstractForm
{
    public function build(): CookieConsentInstallForm
    {
        if (!$this->setting->has(CookieConsentEnum::COOKIECONSENT_POPUP_BACKGROUNDCOLOR, false)) :
            $this->addColorPicker(
                'Popup background color',
                CookieConsentEnum::COOKIECONSENT_POPUP_BACKGROUNDCOLOR,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::COOKIECONSENT_POPUP_TEXTCOLOR, false)) :
            $this->addColorPicker(
                'Popup text color',
                CookieConsentEnum::COOKIECONSENT_POPUP_TEXTCOLOR,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::COOKIECONSENT_BUTTON_BACKGROUNDCOLOR, false)) :
            $this->addColorPicker(
                'Button background color',
                CookieConsentEnum::COOKIECONSENT_BUTTON_BACKGROUNDCOLOR,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::COOKIECONSENT_BUTTON_TEXTCOLOR, false)) :
            $this->addColorPicker(
                'Button text color',
                CookieConsentEnum::COOKIECONSENT_BUTTON_TEXTCOLOR,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::COOKIECONSENT_CONTENT_MESSAGE, false)) :
            $this->addText(
                'Message',
                CookieConsentEnum::COOKIECONSENT_CONTENT_MESSAGE,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::COOKIECONSENT_CONTENT_DISMISS, false)) :
            $this->addText(
                'Content dismiss',
                CookieConsentEnum::COOKIECONSENT_CONTENT_DISMISS,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::COOKIECONSENT_CONTENT_LINK, false)) :
            $this->addText(
                'Content link',
                CookieConsentEnum::COOKIECONSENT_CONTENT_LINK,
                ( new Attributes())->setRequired()
            );
        endif;

        if (!$this->setting->has(CookieConsentEnum::COOKIECONSENT_CONTENT_URL, false)) :
            $this->addText(
                'Content url',
                CookieConsentEnum::COOKIECONSENT_CONTENT_URL,
                ( new Attributes())->setRequired()
            );
        endif;

        $this->addSubmitButton('create');

        return $this;
    }
}