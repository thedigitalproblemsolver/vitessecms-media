<?php declare(strict_types=1);

namespace VitesseCms\Media\Listeners;

use Phalcon\Events\Event;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Media\Enums\CookieConsentEnum;

class CookieConsentListener
{
    /**
     * @var bool
     */
    private $isAdmin;

    public function __construct(bool $isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    public function loadGeneric(Event $event, InjectableInterface $controller): void
    {
        if (
            !$this->isAdmin
            && $controller->view->getVar('embedded') !== 1
            && $controller->setting->has(CookieConsentEnum::POPUP_BACKGROUNDCOLOR)
            && $controller->setting->has(CookieConsentEnum::POPUP_TEXTCOLOR)
            && $controller->setting->has(CookieConsentEnum::BUTTON_BACKGROUNDCOLOR)
            && $controller->setting->has(CookieConsentEnum::BUTTON_TEXTCOLOR)
            && $controller->setting->has(CookieConsentEnum::CONTENT_MESSAGE)
            && $controller->setting->has(CookieConsentEnum::CONTENT_DISMISS)
            && $controller->setting->has(CookieConsentEnum::CONTENT_LINK)
            && $controller->setting->has(CookieConsentEnum::CONTENT_URL)
            && $controller->cookies->get(CookieConsentEnum::COOKIECONSENT_STATUS)->getValue() !== 'dismiss'
        ) :
            $controller->assets->loadCookieConsent();
            $controller->view->setVar('showCookieConsent', true);
        endif;
    }
}