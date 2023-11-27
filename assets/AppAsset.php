<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/site/plugins/fontawesome-free/css/all.min.css',
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        '/site/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
        '/site/plugins/jqvmap/jqvmap.min.css',
        '/site/css/adminlte.min.css',
    ];
    public $js = [

        '/site/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        '/site/js/adminlte.js',

        'https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js',
    ];
    public $depends = [
       'yii\web\YiiAsset',
       BootstrapPluginAsset::class,
    ];
}
