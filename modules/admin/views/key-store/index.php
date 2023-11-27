<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\KeyStoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Key Stores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body">

        <div class="card-header">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Create Key Store', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

        </div>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,

                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'key',
                            [
                                'attribute'=>'value',
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
