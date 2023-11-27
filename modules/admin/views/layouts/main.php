<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

/**
 * Do not use this code in your template. Remove it.
 * Instead, use the code `$this->layout = 'login';` in your controller.
 * (`yii\web\ErrorAction` also support changing layout by setting `layout` property)
 */
$action = Yii::$app->controller->action->id;
if (in_array($action, ['login', 'error'])) {

    echo $this->render('login', ['content' => $content]);
    return;
}

/**
 * You could set your AppAsset depended with AdminlteAsset
 */
// \backend\assets\AppAsset::register($this);
// \app\assets\AppAsset::register($this);
$adminlteAsset = \app\assets\AppAsset::register($this);

$distPath = $adminlteAsset->baseUrl;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="sidebar-mini" style="height: auto;">
<?php $this->beginBody() ?>
<div class="wrapper">

    <?= $this->render('main/header.php', [
        'directoryAsset' => $distPath
    ]) ?>
    
    <?= $this->render('main/aside.php', [
        'directoryAsset' => $distPath
    ]) ?>

    <?= $this->render('main/content.php', [
        'content' => $content, 'directoryAsset' => $distPath
    ]) ?>

    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.4
        </div>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

