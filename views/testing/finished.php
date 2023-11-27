<?php

/* @var $this yii\web\View */

/* @var $model TestingSession */

/* @var $formModel TestFinish */

use app\components\DateEnum;
use app\components\TimeList;
use app\models\KeyStore;
use app\models\TestFinish;
use app\models\TestingSession;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\MaskedInput;

$this->title = 'Приложение для тестирования.';
?>

<div class="tab-content p-0 center-block">
    <h1 class="text-center"><?= $model->questionType ? $model->questionType->name : '' ?></h1>
    <h5 class="text-center">
        <?php
        $total = count($model->results);
        $correct = count(array_filter($model->results, static function ($item) {
            return $item->is_correct;
        }));
        $percentage = $correct * 2;
        ?>
        Вы набрали
    </h5>
    <h1 class="text-center <?=$percentage>78?'text-success':'text-danger'?>" style="font-size: 90px">
        <?= $percentage ?>
    </h1>
    <h3 class="text-center">
        <?=$percentage>78?'<span class="badge badge-success">Успешно</span>':'<label class="badge badge-danger">Не успешно</label>'?>
    </h3>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($formModel, 'first_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($formModel, 'last_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($formModel, 'phones')->widget(MaskedInput::class, [
        'mask' => '\+\9\9\8 \(99\) 999 99 99'
    ]) ?>
    <?= $form->field($formModel, 'dob')->textInput(['type'=>'date','maxlength' => true]) ?>

    <?= Html::submitButton('Отправить Заявку', ['class' => 'btn btn-success']) ?>
    <?php $form::end() ?>

</div>
