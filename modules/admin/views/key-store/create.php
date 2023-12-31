<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KeyStore */

$this->title = 'Create Key Store';
$this->params['breadcrumbs'][] = ['label' => 'Key Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="key-store-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
