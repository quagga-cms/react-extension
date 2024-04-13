<?php

namespace Quagga\Extension\React;

use Quagga\Constracts\Assets\AssetConstract;
use Quagga\Constracts\AssetTypeEnum;
use Quagga\Constracts\BackendExtensionConstract;
use Quagga\Constracts\FrontendExtensionConstract;
use Quagga\Quagga\AssetManager;
use Quagga\Quagga\Assets\AssetScriptOptions;
use Quagga\Quagga\Env;
use Quagga\Quagga\Extension;
use Quagga\Quagga\Helper;
use Quagga\Quagga\HookManager;
use Quagga\Extension\Layout\TemplateManager;

class ReactExtension extends Extension implements FrontendExtensionConstract, BackendExtensionConstract
{
    protected static $react;
    protected static $reactDOM;
    protected static $preact;


    const REACT_FRONTEND_TEMPLATE = 'app.twig';

    public function getReactAsset($isPreact=false): AssetConstract {
        if ($isPreact) {
            if (is_null(static::$preact)) {
                static::$preact = AssetManager::create(
                    'react',
                    Helper::createExtensionAssetUrl(
                        $this->getExtensionDir(),
                        $isPreact ? 'vendors/preact.umd.js' : 'vendors/react.development.js',
                        $isPreact ? 'vendors/preact.min.js' : 'vendors/react.production.min.js'
                    ),
                    AssetTypeEnum::JS(),
                    [],
                    '10.17.1',
                    AssetScriptOptions::parseOptionFromArray([])
                );
            }
            return static::$preact;
        }
        if (is_null(static::$react)) {
            static::$react = AssetManager::create(
                'react',
                Helper::createExtensionAssetUrl(
                    $this->getExtensionDir(),
                    $isPreact ? 'vendors/preact.umd.js' : 'vendors/react.development.js',
                    $isPreact ? 'vendors/preact.min.js' : 'vendors/react.production.min.js'
                ),
                AssetTypeEnum::JS(),
                [],
                '18.2.0',
                AssetScriptOptions::parseOptionFromArray([])
            );
        }
        return static::$react;
    }

    public function getReactDOMAsset(): AssetConstract {
        if (is_null(static::$reactDOM)) {
            static::$reactDOM = AssetManager::create(
                'react-dom',
                Helper::createExtensionAssetUrl(
                    $this->getExtensionDir(),
                    'vendors/react-dom.development.js',
                    'vendors/react-dom.production.min.js'
                ),
                AssetTypeEnum::JS(),
                [],
                '18.2.0',
                AssetScriptOptions::parseOptionFromArray([])
            );
        }
        return static::$reactDOM;
    }


    public function bootstrap()
    {
    }

    public function run() {
        if (Env::get('REACT_FRONTEND', false)) {
            $view = TemplateManager::getView();
            if (!is_null($view)) {
                $view->addPath(implode(DIRECTORY_SEPARATOR, [$this->getExtensionDir(), 'resources', 'views']));
            }
            HookManager::addFilter('home_template', function($template){
                return static::REACT_FRONTEND_TEMPLATE;
            });

            HookManager::addFilter('global_controller_response', function($repsonse, $request){
                return view(
                    HookManager::applyFilters('home_template', 'pages/home'),
                    HookManager::applyFilters('home_data', [])
                );
            }, 10, 2);
        }
    }
}
