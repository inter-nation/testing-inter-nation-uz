<?php

use app\models\QuestionType;
use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $form yii\widgets\ActiveForm */
$this->registerJs("
function switches()
{
//Initialize Select2 Elements
        $(\"input[data-bootstrap-switch]\").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));      
            $(this).bootstrapSwitch('offText', 'No');      
            $(this).bootstrapSwitch('onText', 'Yes');      
        });
}
$(function () {
        switches();
    })
jQuery('#answers').on('afterInit', function(){
    switches()
}).on('afterAddRow', function(e, row, currentIndex) {
    switches()
});
")
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question_type_id')->dropDownList(ArrayHelper::map(
        QuestionType::find()->all(),
        'id',
        'name'
    ), [
        'prompt' => '... Select Question Type'
    ]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'answers')->widget(MultipleInput::class, [
        'max' => 4,
        'id'=>'answers',
        'options'=>[
            'onChange'=>'switches();'
        ],
        'showGeneralError'=>true,
        'enableError'=>true,
        'iconMap' => [
            'fa' => [
                'drag-handle'   => 'fas fa-bars',
                'remove'        => 'fas fa-times',
                'add'           => 'fas fa-plus',
                'clone'         => 'fas fa-files-o',
            ],
        ],
        'iconSource'=>'fa',
        'columns' => [
            [
                'name' => 'answer_option',
                'type' => 'textinput',
                'title' => 'Answer Option',
            ],
            [
                'name' => 'is_right_answer',
                'type' => 'checkbox',
                'title' => 'Is right answer',
                'options' => [
                    'data-bootstrap-switch'=>true,
                ]
            ],
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
