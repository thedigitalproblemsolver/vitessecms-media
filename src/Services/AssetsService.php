<?php declare(strict_types=1);

namespace VitesseCms\Media\Services;

use Phalcon\Assets\Manager;

class AssetsService extends Manager
{
    /**
     * @var array
     */
    protected $used;

    /**
     * @var array
     */
    protected $js;

    /**
     * @var array
     */
    protected $css;

    /**
     * @var string
     */
    protected $webDir;

    public function __construct(string $webDir)
    {
        parent::__construct();

        $this->webDir = $webDir;
        $this->used = [];
        $this->js = [];
        $this->css = [];
    }

    public function loadAdmin(): void
    {
        $this->loadSortable();
        $this->loadEditor();
        $this->loadSelect2();
        $this->js['site-admin'] = '/assets/default/js/admin.js?v=' . filemtime($this->webDir . '/assets/default/js/admin.js');
        $this->css['site-admin'] = '/assets/default/css/admin.css?v=' . filemtime($this->webDir . '/assets/default/css/admin.css');
    }

    public function loadSortable(): void
    {
        $this->loadJquery();
        $this->js['sortable'] = '//cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable-min.js';
    }

    public function loadShop(): void
    {
        $this->js['shop'] = 'shop.js';
    }

    public function loadMustache(): void
    {
        $this->js['mustache'] = '//cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.1/mustache.min.js';
        $this->loadJquery();
        $this->js['jquery-mustache'] = 'jquery.mustache.js';
    }

    public function loadFileManager(): void
    {
        $this->loadJquery();
        $this->loadFontAwesome();
        $this->loadSite();
        $this->css['filemanager'] = 'filemanager.css';
        $this->js['filemanager'] = 'filemanager.js';
    }

    public function loadFontAwesome(): void
    {
        $this->css['font-awesome'] = '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';
    }

    public function loadFacebook(): void
    {
        $this->js['facebook'] = 'facebook.js';
    }

    public function loadEditor(): void
    {
        $this->loadSummerNote();
    }

    public function loadSummerNote(): void
    {
        $this->loadBootstrapJs();
        $this->js['summernote'] = '//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js';
        $this->css['summernote'] = '//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css';
    }


    public function loadCookieConsent(): void
    {
        $this->js['cookieconsent'] = '//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.1/cookieconsent.min.js';
        $this->css['cookieconsent'] = '//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.1/cookieconsent.min.css';
    }

    public function loadBootstrapColorPicker(): void
    {
        $this->loadBootstrapJs();
        $this->js['bootstrap-colorpicker'] = 'bootstrap-colorpicker.min.js';
    }

    public function loadBootstrapToggle(): void
    {
        $this->loadBootstrapJs();
        $this->js['bootstrap4-toggle'] = '//cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js';
        $this->css['bootstrap4-toggle'] = '//cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css';
    }

    public function loadBootstrapJs(): void
    {
        $this->loadJquery();
        $this->js['popper'] = '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js';
        $this->js['tether'] = '//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js';
        $this->js['bootstrap'] = '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js';
    }

    public function loadRecaptcha(): void
    {
        $this->js['recaptcha-api'] = '//www.google.com/recaptcha/api.js';
    }

    public function loadSelect2(): void
    {
        $this->loadJquery();
        $this->js['select2'] = '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js';
        $this->js['select2Sortable'] = 'select2Sortable.js';
        $this->css['select2'] = '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css';
    }

    public function loadFilter(): void
    {
        $this->loadJquery();
        $this->loadSlider();
        $this->js['filter-js'] = 'filter.js';
    }

    public function loadSlider(): void
    {
        $this->loadJquery();
        $this->loadSite();
        $this->js['bootstrap-slider'] = 'bootstrap-slider.min.js';
        $this->css['bootstrap-slider'] = 'bootstrap-slider.min.css';
    }

    public function loadSite(): void
    {
        $this->loadJquery();
        $this->js['helper-js'] = 'helper.js';
        $this->js['ui-js'] = 'ui.js';
        $this->js['form-js'] = 'form.js';
        $this->js['ajax-js'] = 'ajax.js';
        $this->js['sys-js'] = 'sys.js';
    }

    public function loadGoogleMaps(string $apiKey): void
    {
        $this->js['google-maps-1'] = '//maps.google.com/maps/api/js?key=' . $apiKey;
        $this->js['google-maps-2'] = '//cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.25/gmaps.min.js';
    }

    public function loadJquery(): void
    {
        $this->js['jquery'] = '//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js';
    }

    public function loadTheGoogle(): void
    {
        $this->js['theGoogle'] = 'theGoogle.js';
    }

    public function loadLazyLoading(): void
    {
        $this->loadJquery();
        $this->js['lazyload'] = '//cdnjs.cloudflare.com/ajax/libs/jquery_lazyload/1.9.7/jquery.lazyload.min.js';
    }

    public function insertJs(string $url): void
    {
        $this->js[] = $url;
    }

    public function getByType(string $type): array
    {
        switch ($type) :
            case 'js':
                return $this->js;
            case 'css':
                return $this->css;
        endswitch;

        return [];
    }
}
