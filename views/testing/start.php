<?php

/* @var $this yii\web\View */

/* @var $model \app\models\QuestionType */

use app\models\KeyStore;
use yii\helpers\Html;

$this->title = 'Приложение для тестирования.';
?>
<div class="tab-content p-0 center-block">
    <div class="form-group text-center">
        <div class="col-md-12 text-center">
            <?= Html::a('Начать тестирование', ['/testing/create', 'slug' => $model->slug], [
                'class' => 'btn btn-success',
                'data' => [
                    'method' => 'POST'
                ]
            ]) ?>
        </div>
    </div>
</div>
