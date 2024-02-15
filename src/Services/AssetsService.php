<?php

declare(strict_types=1);

namespace VitesseCms\Media\Services;

use Phalcon\Assets\Exception;
use Phalcon\Assets\Filters\Cssmin;
use Phalcon\Assets\Filters\Jsmin;
use Phalcon\Assets\Inline;
use Phalcon\Assets\Manager;
use Phalcon\Html\TagFactory;
use Phalcon\Tag;

class AssetsService extends Manager
{
    /**
     * @var array|string[]
     */
    private array $javascript;
    /**
     * @var array|string[]
     */
    private array $css;
    /**
     * @var array|string[]
     */
    private array $eventLoaders;
    private string $headCode;

    /**
     * @param array<mixed> $options
     */
    public function __construct(
        private readonly string $webDir,
        private readonly string $account,
        private readonly string $baseUri,
        TagFactory $tagFactory,
        array $options = []
    ) {
        parent::__construct($tagFactory, $options);

        $this->javascript = [];
        $this->css = [];
        $this->eventLoaders = [];
        $this->headCode = '';
    }

    /**
     * @return array|string[]
     */
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
        $this->loadMustache();
        $this->javascript['site-admin'] = '/assets/default/js/admin.js?v='.filemtime(
                $this->webDir.'/assets/default/js/admin.js'
            );
        $this->css['site-admin'] = '/assets/default/css/admin.css?v='.filemtime(
                $this->webDir.'/assets/default/css/admin.css'
            );
    }

    public function loadSortable(): void
    {
        $this->loadJquery();
        $this->javascript['sortable'] = '//cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable-min.js';
    }

    public function loadJquery(): void
    {
        $this->javascript['jquery'] = '//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js';
    }

    public function loadEditor(): void
    {
        $this->loadSummerNote();
    }

    public function loadSummerNote(): void
    {
        $this->loadBootstrapJs();
        $this->javascript['summernote'] = '//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js';
        $this->css['summernote'] = '//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css';
    }

    public function loadBootstrapJs(): void
    {
        $this->loadJquery();
        $this->javascript['popper'] = '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js';
        $this->javascript['tether'] = '//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js';
        $this->javascript['bootstrap'] = '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js';
    }

    public function loadSelect2(): void
    {
        $this->loadJquery();
        $this->javascript['select2'] = '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js';
        $this->javascript['select2Sortable'] = 'select2Sortable.js';
        $this->css['select2'] = '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css';
    }

    public function loadFontAwesome(): void
    {
        $this->css['font-awesome'] = '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';
    }

    public function loadMustache(): void
    {
        $this->loadJquery();
        $this->javascript['mustache'] = '//cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.1/mustache.min.js';
        $this->javascript['jquery-mustache'] = 'jquery.mustache.js';
    }

    public function loadShop(): void
    {
        $this->javascript['shop'] = 'shop.js';
    }

    public function loadFileManager(): void
    {
        $this->loadJquery();
        $this->loadFontAwesome();
        $this->loadSite();
        $this->css['filemanager'] = 'filemanager.css';
        $this->javascript['filemanager'] = 'filemanager.js';
    }

    public function loadSite(): void
    {
        $this->javascript['helper-js'] = 'helper.js';
        $this->javascript['ui-js'] = 'ui.js';
        $this->javascript['form-js'] = 'form.js';
        $this->javascript['ajax-js'] = 'ajax.js';
        $this->javascript['sys-js'] = 'sys.js';
    }

    public function loadCookieConsent(): void
    {
        $this->javascript['cookieconsent'] = '//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.1/cookieconsent.min.js';
        $this->css['cookieconsent'] = '//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.1/cookieconsent.min.css';
    }

    public function loadBootstrapColorPicker(): void
    {
        $this->loadBootstrapJs();
        $this->javascript['bootstrap-colorpicker'] = 'bootstrap-colorpicker.min.js';
    }

    public function loadBootstrapToggle(): void
    {
        $this->loadBootstrapJs();
        $this->javascript['bootstrap4-toggle'] = '//cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js';
        $this->css['bootstrap4-toggle'] = '//cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css';
    }

    public function loadRecaptcha(): void
    {
        $this->javascript['recaptcha-api'] = '//www.google.com/recaptcha/api.js';
    }

    public function loadFilter(): void
    {
        $this->loadJquery();
        $this->loadSlider();
        $this->javascript['filter-js'] = 'filter.js';
    }

    public function loadSlider(): void
    {
        $this->loadJquery();
        $this->loadSite();
        $this->javascript['bootstrap-slider'] = 'bootstrap-slider.min.js';
        $this->css['bootstrap-slider'] = 'bootstrap-slider.min.css';
    }

    public function loadGoogleMaps(string $apiKey): void
    {
        $this->javascript['google-maps-1'] = '//maps.google.com/maps/api/js?key='.$apiKey;
        $this->javascript['google-maps-2'] = '//cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.25/gmaps.min.js';
    }

    public function loadJqueryUi(): void
    {
        $this->loadJquery();
        $this->javascript['jqueryUi'] = '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js';
        $this->css['jqueryUi'] = '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css';
    }

    public function loadTheGoogle(): void
    {
        $this->javascript['theGoogle'] = 'theGoogle.js';
    }

    public function loadLazyLoading(): void
    {
        $this->loadJquery();
        $this->javascript['lazyload'] = '//cdnjs.cloudflare.com/ajax/libs/jquery_lazyload/1.9.7/jquery.lazyload.min.js';
    }

    public function insertJs(string $url): void
    {
        $this->javascript[] = $url;
    }

    public function insertCss(string $url): void
    {
        $this->css[] = $url;
    }

    public function insertBabel(string $url): void
    {
        $this->babel[] = $url;
    }

    public function getInlineJs(): string
    {
        ob_start();
        $this->outputInlineJs();
        $return = ob_get_contents();
        ob_end_clean();

        return (string) $return;
    }

    public function getInlineCss(): string
    {
        ob_start();
        $this->outputInlineCss();
        $return = ob_get_contents();
        ob_end_clean();

        return (string) $return;
    }

    public function addInlineBabel(string $code): void
    {
        $this->loadReact();
        $this->addInlineCode(new Inline('babel', $code));
    }

    public function loadReact(): void
    {
        $this->javascript['react'] = 'https://unpkg.com/react@18/umd/react.development.js';
        $this->javascript['react-dom'] = 'https://unpkg.com/react-dom@18/umd/react-dom.development.js';
        $this->javascript['babel'] = 'https://unpkg.com/@babel/standalone/babel.min.js';
    }

    public function getInlineBabel(): string
    {
        try {
            $babel = $this->get('babel');
            if (count($babel->getCodes()) > 0) {
                $return = '';
                /** @var Inline $code */
                foreach ($babel->getCodes() as $code) {
                    $return .= $code->getContent();
                }

                return '<script type="text/babel">'.(new Jsmin())->filter($return).'</script>';
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return '';
    }

    public function buildAssets(string $type): ?string
    {
        $collection = $this->collection($type);
        $collectionExternal = $this->collection('external'.$type);
        $fileBase = 'assets/'.$this->account.'/'.$type.'/site.'.$type;
        $cacheHash = '';
        $addFunction = 'add'.ucfirst($type);

        if (is_file($this->webDir.$fileBase)) {
            $cacheHash .= filemtime($this->webDir.$fileBase);
            $collection->$addFunction($fileBase);
        }

        foreach ($this->getByType($type) as $file) {
            $link = 'assets/default/'.$type.'/'.$file;
            if (is_file($link)) {
                $cacheHash .= filemtime($link);
                if (0 === substr_count($file, '.'.$type)) {
                    $link = $this->baseUri.$file.'?v='.filemtime($link);
                }
                $collection->$addFunction($link);
            } else {
                $collectionExternal->$addFunction($file, false);
            }
        }

        $filename = md5($cacheHash);
        $combinedFile = 'assets/'.$this->account.'/'.$type.'/cache/'.$filename.'.'.$type;

        $collection->join(true);
        $collection->setTargetPath($this->webDir.$combinedFile);
        $collection->setTargetUri($combinedFile);
        switch ($type) {
            case 'js':
                if (!is_file($this->webDir.$combinedFile) || isset($_SESSION['cache'])) {
                    $collection->addFilter(new Jsmin());
                    $this->outputJs($type);
                }

                $tags = '';
                ob_start();
                $this->outputJs('external'.$type);
                $tags .= ob_get_contents();
                ob_end_clean();
                $tags .= Tag::javascriptInclude($combinedFile);

                return $tags;
            case 'css':
                if (!is_file($this->webDir.$combinedFile) || isset($_SESSION['cache'])) {
                    $collection->addFilter(new Cssmin());
                    $this->outputCss($type);
                }

                $tags = '';
                ob_start();
                $this->outputCss('external'.$type);
                $tags .= ob_get_contents();
                ob_end_clean();
                $tags .= Tag::stylesheetLink($combinedFile);

                return $tags;
        }

        return null;
    }

    /**
     * @return array|string[]
     */
    public function getByType(string $type): array
    {
        return match ($type) {
            'js' => $this->javascript,
            'css' => $this->css,
            default => [],
        };
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
