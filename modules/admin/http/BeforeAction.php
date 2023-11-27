<?php

namespace app\modules\admin\http;


use app\models\Student;
use app\models\User;
use Yii;
use yii\base\Behavior;
use yii\helpers\Url;
use yii\web\Controller;

class BeforeAction extends Behavior
{

    public $rules = [];

    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction'
        ];
    }


    public function beforeAction()
    {
        if (Yii::$app->user->isGuest) {
            header("Location: ".Url::to(['/site/login'])); /* Redirect browser */
            exit();
        }
    }
}