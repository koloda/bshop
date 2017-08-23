<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <div class="container-fluid clear-top">
            <div class="row">
                <?php include 'imagecms_header.php' ?>

                <div class="col-sm-2">
                    <?php
                    NavBar::begin([
                            'brandLabel' => false,
                            'brandUrl' => false,
                            'options' => [
                            'class' => 'navbar-inverse navbar-fixed-side',
                            'id'    => 'bshop-admin-navbar'
                            ],
                        ]);
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav', 'activateItems' => true],
                        'items' => [
                        [
                        'label' => 'Products',
                        'url' => ['/product'],
                        'active' => strpos($this->context->route, 'product') === 0
                        ],
                        [
                        'label' => 'Categories',
                        'url' => ['/category'],
                        'active' => strpos($this->context->route, 'category') === 0
                        ],
                        [
                        'label' => 'Brands',
                        'url' => ['/brand'],
                        'active' => strpos($this->context->route, 'brand') === 0
                        ],
                        [
                        'label' => 'Product properties',
                        'url' => ['/property'],
                        'active' => strpos($this->context->route, 'property') === 0
                        ],
                        ],
                        ]);
                    NavBar::end();
                    ?>
                </div>


                <div class="col-sm-10" id="content">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
<div class="row">
    <footer class="footer">
            <p class="col-sm-2">&copy; My Company <?= date('Y') ?></p>

            <div class="col-sm-10">
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
    </footer>
</div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
