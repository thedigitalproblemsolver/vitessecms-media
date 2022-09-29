<?php declare(strict_types=1);

namespace VitesseCms\Media\Enums;

use VitesseCms\Core\AbstractEnum;

class CookieConsentEnum extends AbstractEnum
{
    public const COOKIECONSENT_POPUP_BACKGROUNDCOLOR = 'COOKIECONSENT_POPUP_BACKGROUNDCOLOR';
    public const COOKIECONSENT_POPUP_TEXTCOLOR = 'COOKIECONSENT_POPUP_TEXTCOLOR';
    public const COOKIECONSENT_BUTTON_BACKGROUNDCOLOR = 'COOKIECONSENT_BUTTON_BACKGROUNDCOLOR';
    public const COOKIECONSENT_BUTTON_TEXTCOLOR = 'COOKIECONSENT_BUTTON_TEXTCOLOR';
    public const COOKIECONSENT_CONTENT_MESSAGE = 'COOKIECONSENT_CONTENT_MESSAGE';
    public const COOKIECONSENT_CONTENT_DISMISS = 'COOKIECONSENT_CONTENT_DISMISS';
    public const COOKIECONSENT_CONTENT_LINK = 'COOKIECONSENT_CONTENT_LINK';
    public const COOKIECONSENT_CONTENT_URL = 'COOKIECONSENT_CONTENT_URL';
}