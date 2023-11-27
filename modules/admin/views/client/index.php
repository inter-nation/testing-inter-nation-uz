<?php

use kartik\grid\GridView;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Client', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_name',
            'inn',
            'contact_name',
            'phone_number',
            //'activity_type',
            //'activity_address',
            //'retail_count',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'responsive' => true,
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => 'Collected Data'
        ],
        'toolbar' => [
            '{export}',
            '{toggleData}'
        ],
        'exportConfig' => [
            GridView::CSV => [
                'label' => Yii::t('app', 'CSV'),
                'icon' => 'file-code-o',
                'iconOptions' => ['class' => 'text-primary'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => Yii::t('app', 'grid-export'),
                'alertMsg' => Yii::t('app', 'The CSV export file will be generated for download.'),
                'options' => ['title' => Yii::t('app', 'Comma Separated Values')],
                'mime' => 'application/csv',
                'config' => [
                    'colDelimiter' => ",",
                    'rowDelimiter' => "\r\n",
                ]
            ],
            GridView::EXCEL => [
                'label' => Yii::t('app', 'Excel'),
                'icon' => 'file-excel-o',
                'iconOptions' => ['class' => 'text-success'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => Yii::t('app', 'grid-export'),
                'alertMsg' => Yii::t('app', 'The EXCEL export file will be generated for download.'),
                'options' => ['title' => Yii::t('app', 'Microsoft Excel 95+')],
                'mime' => 'application/vnd.ms-excel',
                'config' => [
                    'worksheet' => Yii::t('app', 'ExportWorksheet'),
                    'cssFile' => ''
                ]
            ],
        ],
        'resizableColumns' => true,
        'resizeStorageKey' => Yii::$app->user->id . '-' . date("m-Y")
    ])
    ?>

</div>
