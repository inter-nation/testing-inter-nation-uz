<?php

/* @var $this yii\web\View */

/* @var $model Question */
/* @var $questionType QuestionType */
/* @var $results \app\models\TestingResults[] */

/* @var $session \app\models\TestingSession */

use app\models\KeyStore;
use app\models\Question;
use app\models\QuestionType;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Приложение для тестирования.';
?>

<?php $form = ActiveForm::begin([
    'action' => ['save-result', 'slug' => $session->question_type_slug],
    'method' => 'POST'
]); ?>
<?php
$datetime1 = new DateTime();
$datetime2 = new DateTime($session->finishes_at);
$interval = $datetime1->diff($datetime2);
$displayTime = $interval->i . ':' . str_pad($interval->s, 2, '0', STR_PAD_LEFT);
?>
<style>
    .btn-lg {
        max-width: 160px !important;
        margin:0 !important;
        font-size: 17px !important;
    }
</style>
    <div >
        <h5 class="text-center">To'g'ri variantni tanlang</h5>
        <h5 class="text-center">Выберите правильный вариант</h5>
        <h5 class="text-center">Choose the correct answer.</h5>
        <br/>
        <h4 class="text-center"> <?php echo str_replace("\n",'<br/>',trim($model->description)) ?></h4>
        <?= Html::hiddenInput('question_id', $model->id); ?>
        <hr/>
        <div class="col-md-8 offset-md-2">
            <ul class=" products-list">
                <?php
                $answers = $model->answers;
                shuffle($answers)
                ?>
                <?php foreach ($answers as $answer): ?>
                    <li class=" item">
                        <div class="icheck-success d-inline">
                            <input type="radio" name="answer" value="<?= $answer->id ?>"
                                   id="answer_<?= $answer->id ?>" required>
                            <label for="answer_<?= $answer->id ?>">
                                <?= $answer->title ?>
                            </label>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
        $left = $interval->i + round(($interval->s / 60), 2);
        ?>
        <div class="clearfix"><br/><br/></div>
        <div class="text-center" style="padding: 0 !important; margin: 0 !important;">
            <button class="btn bg-gradient-success btn-lg center-block" >
                Принять ответ
            </button>
            <?= Html::a(
                '<i class="fas fa-arrow-right"></i> НЕ знаю ответ',
                ['testing/skip', 'slug' => $session->question_type_slug, 'question_id' => $model->id],
                [
                    'class' => "btn btn-default btn-lg float-right",
                    'data' => [
                        'method' => 'POST',
                        'confirm' => 'Вы уверены? Ответ будет выбран как неправильный.'
                    ]
                ]
            ) ?>
        </div>
        <br/>
        <hr/>
        <div class="row">
            <div class="col">
                Вопрос <?= count($results)+1 ?> из <?= count($questionType->questions) ?>
            </div>
            <div class="col">
                <div class="d-none d-sm-block d-md-none d-lg-none d-xl-none d-block">
                    <p class="text-center text-danger">Осталось: <span
                                id="timetracker2"><?= $displayTime ?></span></p>
                </div>
                <div class="d-none d-lg-block d-xl-block d-md-block d-xl-none d-sm-none">
                    <p class="text-right text-danger">Осталось: <span id="timetracker1"><?= $displayTime ?></span></p>
                </div>
            </div>
        </div>
    </div>
<?php $form::end(); ?>

<?php
$this->registerJs("
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? \"0\" + minutes : minutes;
        seconds = seconds < 10 ? \"0\" + seconds : seconds;

        display.textContent = minutes + \":\" + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
    var minutesLeft = 60 * {$left},
    display = document.querySelector('#timetracker1')   
    startTimer(minutesLeft, display);
    display = document.querySelector('#timetracker2')
    startTimer(minutesLeft, display);
};
");