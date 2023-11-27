<?php

use app\components\AdminMenuWidget;
use yii\helpers\Url;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="/site/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Online Testing</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/site/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=Yii::$app->user->identity->username?></a>
            </div>
        </div>
        <nav class="mt-2">
            <?= AdminMenuWidget::widget([
                'columns' => [
                    [
                        'icon' => 'nav-icon far fa-calendar-alt',
                        'content' => 'Key Strore',
                        'url'=>'/admin/key-store/index',
                        'visible' => true
                    ],
                    [
                        'icon' => 'nav-icon far fa-calendar-alt',
                        'content' => 'Questions',
                        'url'=>'/admin/question/index',
                        'visible' => true
                    ],
                    [
                        'icon' => 'nav-icon far fa-calendar-alt',
                        'content' => 'Questions Type',
                        'url'=>'/admin/question-type/index',
                        'visible' => true
                    ],
                ],
            ]) ?>
        </nav>
    </div>
</aside>