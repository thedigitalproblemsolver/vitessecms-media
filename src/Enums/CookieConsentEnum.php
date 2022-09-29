<?php declare(strict_types=1);

namespace VitesseCms\Media\Enums;

use VitesseCms\Core\AbstractEnum;

class CookieConsentEnum extends AbstractEnum
{
    public const POPUP_BACKGROUNDCOLOR = 'COOKIECONSENT_POPUP_BACKGROUNDCOLOR';
    public const POPUP_TEXTCOLOR = 'COOKIECONSENT_POPUP_TEXTCOLOR';
    public const BUTTON_BACKGROUNDCOLOR = 'COOKIECONSENT_BUTTON_BACKGROUNDCOLOR';
    public const BUTTON_TEXTCOLOR = 'COOKIECONSENT_BUTTON_TEXTCOLOR';
    public const CONTENT_MESSAGE = 'COOKIECONSENT_CONTENT_MESSAGE';
    public const CONTENT_DISMISS = 'COOKIECONSENT_CONTENT_DISMISS';
    public const CONTENT_LINK = 'COOKIECONSENT_CONTENT_LINK';
    public const CONTENT_URL = 'COOKIECONSENT_CONTENT_URL';
    public const POSITION = 'COOKIECONSENT_POSITION';
    public const COOKIECONSENT_STATUS = 'cookieconsent_status';
}