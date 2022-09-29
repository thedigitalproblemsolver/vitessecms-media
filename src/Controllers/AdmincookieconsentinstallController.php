<?php declare(strict_types=1);

namespace VitesseCms\Media\Controllers;

use VitesseCms\Install\AbstractCreatorController;
use VitesseCms\Media\Enums\CookieConsentEnum;
use VitesseCms\Media\Forms\CookieConsentInstallForm;
use VitesseCms\Setting\Enum\TypeEnum;

class AdmincookieconsentinstallController extends AbstractCreatorController
{
    public function createAction()
    {
        $this->view->setVar(
            'content',
            (new CookieConsentInstallForm())
                ->build()
                ->renderForm('admin/media/admincookieconsentinstall/parseCreateForm')
        );
        $this->prepareView();
    }

    public function parseCreateFormAction()
    {
        $settings = [];

        if (
            !$this->setting->has(CookieConsentEnum::COOKIECONSENT_POPUP_BACKGROUNDCOLOR,false)
            && $this->request->has(CookieConsentEnum::COOKIECONSENT_POPUP_BACKGROUNDCOLOR)
        ) :
            $settings[CookieConsentEnum::COOKIECONSENT_POPUP_BACKGROUNDCOLOR] = [
                'type' => TypeEnum::COLOR,
                'value' => $this->request->get(CookieConsentEnum::COOKIECONSENT_POPUP_BACKGROUNDCOLOR),
                'name' => 'Cookie consent popup backgroundcolor',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::COOKIECONSENT_POPUP_TEXTCOLOR,false)
            && $this->request->has(CookieConsentEnum::COOKIECONSENT_POPUP_TEXTCOLOR)
        ) :
            $settings[CookieConsentEnum::COOKIECONSENT_POPUP_TEXTCOLOR] = [
                'type' => TypeEnum::COLOR,
                'value' => $this->request->get(CookieConsentEnum::COOKIECONSENT_POPUP_TEXTCOLOR),
                'name' => 'Cookie consent popup textcolor',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::COOKIECONSENT_BUTTON_BACKGROUNDCOLOR,false)
            && $this->request->has(CookieConsentEnum::COOKIECONSENT_BUTTON_BACKGROUNDCOLOR)
        ) :
            $settings[CookieConsentEnum::COOKIECONSENT_BUTTON_BACKGROUNDCOLOR] = [
                'type' => TypeEnum::COLOR,
                'value' => $this->request->get(CookieConsentEnum::COOKIECONSENT_BUTTON_BACKGROUNDCOLOR),
                'name' => 'Cookie consent button backgroundcolor',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::COOKIECONSENT_BUTTON_TEXTCOLOR,false)
            && $this->request->has(CookieConsentEnum::COOKIECONSENT_BUTTON_TEXTCOLOR)
        ) :
            $settings[CookieConsentEnum::COOKIECONSENT_BUTTON_TEXTCOLOR] = [
                'type' => TypeEnum::COLOR,
                'value' => $this->request->get(CookieConsentEnum::COOKIECONSENT_BUTTON_TEXTCOLOR),
                'name' => 'Cookie consent button textcolor',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::COOKIECONSENT_CONTENT_MESSAGE,false)
            && $this->request->has(CookieConsentEnum::COOKIECONSENT_CONTENT_MESSAGE)
        ) :
            $settings[CookieConsentEnum::COOKIECONSENT_CONTENT_MESSAGE] = [
                'type' => TypeEnum::TEXT,
                'value' => $this->request->get(CookieConsentEnum::COOKIECONSENT_CONTENT_MESSAGE),
                'name' => 'Cookie consent content message',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::COOKIECONSENT_CONTENT_DISMISS,false)
            && $this->request->has(CookieConsentEnum::COOKIECONSENT_CONTENT_DISMISS)
        ) :
            $settings[CookieConsentEnum::COOKIECONSENT_CONTENT_DISMISS] = [
                'type' => TypeEnum::TEXT,
                'value' => $this->request->get(CookieConsentEnum::COOKIECONSENT_CONTENT_DISMISS),
                'name' => 'Cookie consent content dismiss',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::COOKIECONSENT_CONTENT_LINK,false)
            && $this->request->has(CookieConsentEnum::COOKIECONSENT_CONTENT_LINK)
        ) :
            $settings[CookieConsentEnum::COOKIECONSENT_CONTENT_LINK] = [
                'type' => TypeEnum::TEXT,
                'value' => $this->request->get(CookieConsentEnum::COOKIECONSENT_CONTENT_LINK),
                'name' => 'Cookie consent content link',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::COOKIECONSENT_CONTENT_URL,false)
            && $this->request->has(CookieConsentEnum::COOKIECONSENT_CONTENT_URL)
        ) :
            $settings[CookieConsentEnum::COOKIECONSENT_CONTENT_URL] = [
                'type' => TypeEnum::TEXT,
                'value' => $this->request->get(CookieConsentEnum::COOKIECONSENT_CONTENT_URL),
                'name' => 'Cookie consent content url',
            ];
        endif;

        $this->createSettings($settings);
        $this->flash->setSucces('Cookie consent created');

        $this->redirect('admin/install/sitecreator/index');
    }
}