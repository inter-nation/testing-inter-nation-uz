<?php

namespace app\modules\admin;

use app\modules\admin\http\BeforeAction;
use Yii;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';
    /**
     * @inheritdoc
     */
    public $layout = '@admin/views/layouts/main';
    public $layoutPath = '@admin/views/layouts';
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        Yii::configure($this,
            [
                'as globalAccess' => [
                    'class' => BeforeAction::class,
                ]
            ]
        );
        // custom initialization code goes here
    }
}
