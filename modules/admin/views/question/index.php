<?php

use app\models\QuestionType;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Question', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' =>'question_type_id',
                'value'=>'questionType.name',
                'filter'=> ArrayHelper::map(
                    QuestionType::find()->all(),
                        'id',
                        'name'
                )
            ],
            'description:text',
            'created_at:date',
            [
                'header' => 'Fields',
                'value' => function (\app\models\Question $question) {
                    $badges = [];
                    foreach ($question->answers as $answer) {
                        $badges[] = Html::tag('span', $answer->title, [
                           'class' => [
                               'badge',
                               $answer->is_right_answer ? 'badge-success bg-success' : 'badge-info bg-info',
                               'm-1'
                           ]
                        ]);
                    }
                    return implode("", $badges);
                },
                'format' => 'html'
            ],
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
