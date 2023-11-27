<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\QuestionType */

$this->title = 'Create Question Type';
$this->params['breadcrumbs'][] = ['label' => 'Question Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
