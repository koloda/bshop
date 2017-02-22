<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('bshop', 'Brands');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-index col-xs-12">
    <div class="panel">

        <div class="panel-heading">
            <p><?= Html::encode($this->title) ?>
            <?= Html::a('<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('bshop', 'Create Brand'), ['/brand/create'], ['class' => 'btn btn-success pull-right']) ?>
            </p>
        </div>

        <div class="panel-body">
            <?php Pjax::begin(); ?>
            <?=
            GridView::widget([
                'bordered' => false,
                'layout' => '{items}{summary}{pager}',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'title',
                        'content' => function ($model) {
                            $text = $model->title . ' <i class="glyphicon glyphicon-pencil"></i>';
                            return Html::a($text, ['/brand/update', 'id' => $model->id]);
                        }
                    ],
                    [
                        'attribute' => 'slug',
                        'content' => function($model) {
                            return '/' . $model->slug;
                        }
                    ],
                    [
                        'attribute' => 'active',
                        'class' => '\dixonstarter\togglecolumn\ToggleColumn',
                        'options' => ['class' => 'col-sm-1'],
                        'linkTemplateOff' => '<a class="toggle-column btn btn-warning btn-xs btn-block" data-pjax="0" href="{url}"><i  class="glyphicon glyphicon-remove"></i> {label}</a>'
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'template' => '{delete}'
                    ],
                ],
            ]);
            ?>
        <?php Pjax::end(); ?>
        </div>
    </div>
</div>
