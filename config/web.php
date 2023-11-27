<?php

use app\components\LanguageSetter;
use yii\helpers\Html;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        LanguageSetter::class,
    ],
    'timeZone' => 'Asia/Tashkent',
    'container' => [
        'definitions' => [
            \yii\grid\ActionColumn::class => [
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fas fa-trash-alt"></i>', $url, [
                            'data-method' => 'post',
                            'data-confirm' => 'Are you sure to delete?'
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', $url);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fas fa-eye"></i>', $url);
                    },
                ]
            ]
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'api_v1_3pmkSdmGFEpKl2Lu8mdU4ipLwFm0yL' => [
            'class' => 'app\modules\api\Api',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'language' => 'ru',
    'components' => [
        'assetManager' => [
            'bundles' => [
                'yidas\adminlte\AdminlteAsset' => [
                    'skin' => '_all-skins',
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'DCGWyrZz0lumeaetLdhFE-W_w1pYeEKe',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'change-language'=>'/site/change-language',
                'lang/<lang:\w+>'=>'/site/change-language',
                '/'=>'site/index',
               'start/<slug:\w+>'=>'testing/start',
               'create/<slug:\w+>'=>'testing/create',
               'test/<slug:\w+>'=>'testing/test',
               'finished/<slug:\w+>'=>'testing/finished',
               'success/<slug:\w+>'=>'testing/success',
               'skip/<slug:\w+>/<question_id:\w+>'=>'testing/skip',
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_DEBUG) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}
return $config;
