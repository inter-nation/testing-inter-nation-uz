<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KeyStore */

$this->title = 'Update Key Store: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Key Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="key-store-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
