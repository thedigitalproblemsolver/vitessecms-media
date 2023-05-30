<?php declare(strict_types=1);

namespace VitesseCms\Media\Services;

use Phalcon\Assets\Filters\Cssmin;
use Phalcon\Assets\Filters\Jsmin;
use Phalcon\Assets\Manager;
use Phalcon\Html\TagFactory;
use Phalcon\Tag;

class AssetsService extends Manager
{
    private array $js;
    private array $css;
    private string $webDir;
    private array $eventLoaders;
    private string $account;
    private string $baseUri;
    private string $headCode;

    public function __construct(
        string     $webDir,
        string     $account,
        string     $baseUri,
        TagFactory $tagFactory,
        array      $options = []
    )
    {
        parent::__construct($tagFactory, $options);

        $this->webDir = $webDir;
        $this->account = $account;
        $this->baseUri = $baseUri;
        $this->js = [];
        $this->css = [];
        $this->eventLoaders = [];
        $this->headCode = '';
    }

    public function getEventLoaders(): array
    {
        return $this->eventLoaders;
    }

    public function setEventLoader(string $eventLoader): void
    {
        $this->eventLoaders[$eventLoader] = $eventLoader;
    }

    public function loadAdmin(): void
    {
        $this->loadSortable();
        $this->loadEditor();
        $this->loadSelect2();
        $this->loadFontAwesome();
        $this->js['site-admin'] = '/assets/default/js/admin.js?v=' . filemtime($this->webDir . '/assets/default/js/admin.js');
        $this->css['site-admin'] = '/assets/default/css/admin.css?v=' . filemtime($this->webDir . '/assets/default/css/admin.css');
    }

    public function loadSortable(): void
    {
        $this->loadJquery();
        $this->js['sortable'] = '//cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable-min.js';
    }

    public function loadJquery(): void
    {
        $this->js['jquery'] = '//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js';
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

    public function loadBootstrapJs(): void
    {
        $this->loadJquery();
        $this->js['popper'] = '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js';
        $this->js['tether'] = '//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js';
        $this->js['bootstrap'] = '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js';
    }

    public function loadSelect2(): void
    {
        $this->loadJquery();
        $this->js['select2'] = '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js';
        $this->js['select2Sortable'] = 'select2Sortable.js';
        $this->css['select2'] = '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css';
    }

    public function loadFontAwesome(): void
    {
        $this->css['font-awesome'] = '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';
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

    public function loadSite(): void
    {
        $this->js['helper-js'] = 'helper.js';
        $this->js['ui-js'] = 'ui.js';
        $this->js['form-js'] = 'form.js';
        $this->js['ajax-js'] = 'ajax.js';
        $this->js['sys-js'] = 'sys.js';
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

    public function loadRecaptcha(): void
    {
        $this->js['recaptcha-api'] = '//www.google.com/recaptcha/api.js';
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

    public function loadGoogleMaps(string $apiKey): void
    {
        $this->js['google-maps-1'] = '//maps.google.com/maps/api/js?key=' . $apiKey;
        $this->js['google-maps-2'] = '//cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.25/gmaps.min.js';
    }

    public function loadJqueryUi(): void
    {
        $this->loadJquery();
        $this->js['jqueryUi'] = '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js';
        $this->css['jqueryUi'] = '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css';
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

    public function insertCss(string $url): void
    {
        $this->css[] = $url;
    }

    public function getInlineJs(): string
    {
        ob_start();
        $this->outputInlineJs();
        $return = ob_get_contents();
        ob_end_clean();

        return $return;
    }

    public function getInlineCss(): string
    {
        ob_start();
        $this->outputInlineCss();
        $return = ob_get_contents();
        ob_end_clean();

        return $return;
    }

    public function buildAssets(string $type): ?string
    {
        $collection = $this->collection($type);
        $collectionExternal = $this->collection('external' . $type);
        $fileBase = 'assets/' . $this->account . '/' . $type . '/site.' . $type;
        $cacheHash = '';
        $addFunction = 'add' . ucfirst($type);

        if (is_file($this->webDir . $fileBase)) :
            $cacheHash .= filemtime($this->webDir . $fileBase);
            $collection->$addFunction($fileBase);
        endif;

        foreach ($this->getByType($type) as $file) :
            $link = 'assets/default/' . $type . '/' . $file;
            if (is_file($link)) :
                $cacheHash .= filemtime($link);
                if (substr_count($file, '.' . $type) === 0) :
                    $link = $this->baseUri . $file . '?v=' . filemtime($link);
                endif;
                $collection->$addFunction($link);
            else :
                $collectionExternal->$addFunction($file, false);
            endif;
        endforeach;

        $filename = md5($cacheHash);
        $combinedFile = 'assets/' . $this->account . '/' . $type . '/cache/' . $filename . '.' . $type;

        $collection->join(true);
        $collection->setTargetPath($this->webDir . $combinedFile);
        $collection->setTargetUri($combinedFile);
        switch ($type) :
            case 'js':
                if (!is_file($this->webDir . $combinedFile)) :
                    $collection->addFilter(new Jsmin());
                    $this->outputJs($type);
                endif;

                $tags = '';
                ob_start();
                $this->outputJs('external' . $type);
                $tags .= ob_get_contents();
                ob_end_clean();
                $tags .= Tag::javascriptInclude($combinedFile);

                return $tags;
            case 'css':
                //if (!is_file($this->webDir . $combinedFile)) :
                $collection->addFilter(new Cssmin());
                $this->outputCss($type);
                //endif;

                $tags = '';
                ob_start();
                $this->outputCss('external' . $type);
                $tags .= ob_get_contents();
                ob_end_clean();
                $tags .= Tag::stylesheetLink($combinedFile);

                return $tags;
        endswitch;

        return null;
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

    public function addHeadCode(string $code): void
    {
        $this->headCode .= $code;
    }

    public function getHeadCode(): string
    {
        return $this->headCode;
    }
}
