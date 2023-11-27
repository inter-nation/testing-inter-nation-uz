<?php

use yii\widgets\Breadcrumbs;

/**
 * @var $content string
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <?php
                        echo Breadcrumbs::widget([
                            'tag' => 'ol',
                            'homeLink' => [
                                'label' => Yii::t('yii', 'Dashboard'),
                                'url' => ['/admin'],
                            ],
                            'options' => [
                                'class' => 'breadcrumb float-sm-right',
                            ],
                            'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n",
                            'itemTemplate' => "<li class='breadcrumb-item'><i>{link}</i></li>\n", // template for all links
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]);
                        ?>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?= $content ?>
        </div>
    </section>
</div>
