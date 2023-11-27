<?php

namespace app\modules\api\controllers;

use app\models\Question;
use app\models\QuestionType;
use yii\rest\Controller;
use yii\web\MethodNotAllowedHttpException;

/**
 * Default controller for the `api_v1` module
 */
class RestController extends Controller
{

    public function actionQuestionTypes()
    {
        return QuestionType::find()->all();
    }

    public function actionTests($id)
    {
        return Question::find()->with(['answers'])->where(['question_type_id' => $id])->all();
    }
}
