<?php declare(strict_types=1);

namespace VitesseCms\Media\Controllers;

use Phalcon\Mvc\Controller;
use VitesseCms\Core\Utils\FileUtil;

class AssetsController extends Controller
{
    public function indexAction(): void
    {
        $this->url->setUrl($_SERVER['REQUEST_URI']);
        $urlPath = $this->url->getParsed('path');
        $file = $this->config->get('webDir') . ltrim($urlPath, '/');
        if (is_file($file)) :
            FileUtil::display($file);
        endif;
    }
}
