<?php

namespace PuleenoCMS\React;

use App\Constracts\AssetTypeEnum;
use App\Constracts\BackendExtensionConstract;
use App\Constracts\FrontendExtensionConstract;
use App\Core\AssetManager;
use App\Core\Assets\AssetOptions;
use App\Core\Extension;
use App\Core\ExtensionManager;
use App\Core\Helper;

class ReactExtension extends Extension implements FrontendExtensionConstract, BackendExtensionConstract
{
    protected static $react;

    protected function createReactAsset() {
        return AssetManager::create(
            'react',
            Helper::createExtensionAssetUrl(
                $this->getExtensionDir(),
                'assets/vendors/preact.js',
                'assets/vendors/preact.min.js'
            ),
            AssetTypeEnum::JS(),
            [],
            '10.17.1',
            AssetOptions::parseOptionFromArray([]),
            1
        );

    }

    public function bootstrap()
    {
    }

    public function run() {
    }

    public static function getReact() {
        if (is_null(static::$react)) {
            static::$react = static::createReactAsset();
        }
    }
}
