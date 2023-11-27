<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KeyStore */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="key-store-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>
    <?php
    foreach (\app\components\Languages::LIST_LANGUAGES as $lang) {
        echo $form
            ->field($model, "value[{$lang}]")
            ->textInput(['value'=>$model->value->other($lang)])
            ->label($model->getAttributeLabel('value') . "_{$lang}");
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
