<?php declare(strict_types=1);

namespace VitesseCms\Media\Services;

use Phalcon\Mvc\Router;
use VitesseCms\Core\Services\BootstrapService;

class BootstrapAssetsService extends BootstrapService
{
    public function router(): BootstrapService
    {
        $this->setShared(
            'router',
            function (): Router {
                $router = new Router();
                $router->setDefaultNamespace('VitesseCms\Media\Controllers');
                $router->setDefaultModule('media');
                $router->setDefaultController('assets');
                $router->setDefaultAction('index');

                return $router;
            }
        );

        return $this;
    }
}
