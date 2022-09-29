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
            !$this->setting->has(CookieConsentEnum::POPUP_BACKGROUNDCOLOR,false)
            && $this->request->has(CookieConsentEnum::POPUP_BACKGROUNDCOLOR)
        ) :
            $settings[CookieConsentEnum::POPUP_BACKGROUNDCOLOR] = [
                'type' => TypeEnum::COLOR,
                'value' => $this->request->get(CookieConsentEnum::POPUP_BACKGROUNDCOLOR),
                'name' => 'Cookie consent popup backgroundcolor',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::POPUP_TEXTCOLOR,false)
            && $this->request->has(CookieConsentEnum::POPUP_TEXTCOLOR)
        ) :
            $settings[CookieConsentEnum::POPUP_TEXTCOLOR] = [
                'type' => TypeEnum::COLOR,
                'value' => $this->request->get(CookieConsentEnum::POPUP_TEXTCOLOR),
                'name' => 'Cookie consent popup textcolor',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::BUTTON_BACKGROUNDCOLOR,false)
            && $this->request->has(CookieConsentEnum::BUTTON_BACKGROUNDCOLOR)
        ) :
            $settings[CookieConsentEnum::BUTTON_BACKGROUNDCOLOR] = [
                'type' => TypeEnum::COLOR,
                'value' => $this->request->get(CookieConsentEnum::BUTTON_BACKGROUNDCOLOR),
                'name' => 'Cookie consent button backgroundcolor',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::BUTTON_TEXTCOLOR,false)
            && $this->request->has(CookieConsentEnum::BUTTON_TEXTCOLOR)
        ) :
            $settings[CookieConsentEnum::BUTTON_TEXTCOLOR] = [
                'type' => TypeEnum::COLOR,
                'value' => $this->request->get(CookieConsentEnum::BUTTON_TEXTCOLOR),
                'name' => 'Cookie consent button textcolor',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::CONTENT_MESSAGE,false)
            && $this->request->has(CookieConsentEnum::CONTENT_MESSAGE)
        ) :
            $settings[CookieConsentEnum::CONTENT_MESSAGE] = [
                'type' => TypeEnum::TEXT,
                'value' => $this->request->get(CookieConsentEnum::CONTENT_MESSAGE),
                'name' => 'Cookie consent content message',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::CONTENT_DISMISS,false)
            && $this->request->has(CookieConsentEnum::CONTENT_DISMISS)
        ) :
            $settings[CookieConsentEnum::CONTENT_DISMISS] = [
                'type' => TypeEnum::TEXT,
                'value' => $this->request->get(CookieConsentEnum::CONTENT_DISMISS),
                'name' => 'Cookie consent content dismiss',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::CONTENT_LINK,false)
            && $this->request->has(CookieConsentEnum::CONTENT_LINK)
        ) :
            $settings[CookieConsentEnum::CONTENT_LINK] = [
                'type' => TypeEnum::TEXT,
                'value' => $this->request->get(CookieConsentEnum::CONTENT_LINK),
                'name' => 'Cookie consent content link',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::CONTENT_URL,false)
            && $this->request->has(CookieConsentEnum::CONTENT_URL)
        ) :
            $settings[CookieConsentEnum::CONTENT_URL] = [
                'type' => TypeEnum::TEXT,
                'value' => $this->request->get(CookieConsentEnum::CONTENT_URL),
                'name' => 'Cookie consent content url',
            ];
        endif;

        if (
            !$this->setting->has(CookieConsentEnum::POSITION,false)
            && $this->request->has(CookieConsentEnum::POSITION)
        ) :
            $settings[CookieConsentEnum::POSITION] = [
                'type' => TypeEnum::TEXT,
                'value' => $this->request->get(CookieConsentEnum::POSITION),
                'name' => 'Cookie consent toolbar position',
            ];
        endif;

        $this->createSettings($settings);
        $this->flash->setSucces('Cookie consent created');

        $this->redirect('admin/install/sitecreator/index');
    }
}