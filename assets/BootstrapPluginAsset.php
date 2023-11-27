<?php

namespace app\assets;

use yii\web\AssetBundle;

class BootstrapPluginAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap/dist';
    public $js = [
        'js/bootstrap.js',
    ];
    public $css = [
        'css/bootstrap.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}