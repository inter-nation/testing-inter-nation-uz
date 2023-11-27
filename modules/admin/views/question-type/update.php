<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\QuestionType */

$this->title = 'Update Question Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Question Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="question-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
