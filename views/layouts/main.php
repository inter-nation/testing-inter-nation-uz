<?php

/* @var $this View */

/* @var $content string */

use app\components\Languages;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="sidebar-mini" style="height: auto;">
<?php $this->beginBody() ?>
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <div>
                            <div class="d-none d-sm-block d-md-none d-lg-none d-xl-none d-block">
                                <img src="/logo_long.png" alt="Logo"
                                     style="width: 60% !important; margin: 0 20% !important; ">
                            </div>
                            <div class="d-none d-lg-block d-xl-block d-md-block d-xl-none d-sm-none">
                                <img src="/logo_long.png" alt="Logo"
                                     style="width: 40% !important; margin: 0 30% !important; ">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- endinject -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
