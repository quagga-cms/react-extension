<?php

namespace PuleenoCMS\React;

use App\Constracts\Assets\AssetConstract;
use App\Constracts\AssetTypeEnum;
use App\Constracts\BackendExtensionConstract;
use App\Constracts\FrontendExtensionConstract;
use App\Core\AssetManager;
use App\Core\Assets\AssetScriptOptions;
use App\Core\Extension;
use App\Core\Helper;

class ReactExtension extends Extension implements FrontendExtensionConstract, BackendExtensionConstract
{
    protected static $react;

    public function getReactAsset(): AssetConstract {
        if (is_null(static::$react)) {
            static::$react = AssetManager::create(
                'react',
                Helper::createExtensionAssetUrl(
                    $this->getExtensionDir(),
                    'vendors/preact.umd.js',
                    'vendors/preact.min.js'
                ),
                AssetTypeEnum::JS(),
                [],
                '10.17.1',
                AssetScriptOptions::parseOptionFromArray([])
            );
        }
        return static::$react;
    }


    public function bootstrap()
    {
    }

    public function run() {
    }
}
